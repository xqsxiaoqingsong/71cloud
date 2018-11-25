<?php
/**
 * Created by PhpStorm.
 * User: lwen_phper@163.com
 * Date: 2018/7/25
 * Time: 12:48
 *
 * 党校模型
 *
 *
 */

namespace app\home\model;

use think\Db;
use think\Model;

class Clas extends Model
{

    /**
     *
     * 课程列表
     *
     *
     */
    public function getClassList($p, $pageSize, $cate_id = null)
    {

        $map           = [];
        $map['status'] = 1;
        if ($cate_id != null && $cate_id != 'all') {
            $ids            = getSon(db('ClassCate')->select(), $cate_id);
            $ids[]          = $cate_id;
            $map['cate_id'] = ['IN', $ids];
        }

        $data = db('class')->field('id,name,thumb,visit')->where($map)->order('ctime desc')->page($p, $pageSize)->select();

        return $data;
    }

    /**
     *
     * 用户课程信息
     *
     * @param $uid  int 用户id
     * @param $type int 类型 1表示学习中2表示已完成
     *
     */
    public function getUserClass($uid, $type = null)
    {
        $class = Db::name('user_class')->alias('a')
            ->field('a.over_period ,a.last_time,b.name,b.id,b.thumb,b.period ')
//            ->join('LEFT JOIN p_class as b  on a.class_id=b.id')
            ->join('c_class b ', 'a.class_id=b.id', ' LEFT')
            ->where('a.uid=' . $uid . ' AND b.status = 1')
            ->order('a.ctime desc')
            ->select();
        $study = [];
        $over  = [];
        foreach ($class as $v) {
            //完成的百分比
            $v['percent'] = floor($v['over_period'] / $v['period'] * 100) . '%';
            //剩余课时
            $v['residue'] = $v['period'] - $v['over_period'];

            $res_num = $v['period'] - $v['over_period'];
            if ($res_num) {
//                dump($v);
                $study[] = $v;
            } else {
                //已完成
                $over[] = $v;
            }
        }

        $study = empty($study) ? '' : $study;
        $over  = empty($over) ? '' : $over;
//        dump($type);
//        dump($study);
//        dump($over);
        //正在学习的课程
        if ($type == 1) {
            return $study;
        }
        //已完成的课程
        if ($type == 2) {
            return $over;
        }

        return ['study' => $study, 'over' => $over];
    }

    /**
     *
     * 课程详情页
     *
     */
    public function getClassDetail($uid, $class_id, $chapter_id = null)
    {

        $userClassModel    = Db::name('user_class');
        $userChapterModel  = Db::name('user_chapter');
        $classChapterModel = Db::name('class_chapter');
        $classModel        = Db::name('class');

        //观看量+1
        $classModel->where('id=' . $class_id)->setInc('visit');

        //课程介绍
        $introduce              = $classModel->field('name,introduce')->where('id=' . $class_id)->find();
        $introduce['introduce'] = htmlspecialchars_decode($introduce['introduce']);

        //课程下所有视频
        $data = $classChapterModel->field('id,name,thumb,episode,path,vtime')->where('class_id=' . $class_id . ' AND is_del =0')->order('episode asc')->select();

        //防止后台未传视频
        if (empty($data)) {
            return ['code' => 0, 'msg' => '本课程暂无视频！'];
        }

        foreach ($data as &$v) {
            //循环获取已观看时间
            $see = $userChapterModel->field('see_time,is_over')->where('uid=' . $uid . ' AND chapter_id=' . $v['id'])->find();

            if ($see) {
                $v['see_time'] = $see['see_time'];
                $v['is_over']  = $see['is_over'];
            } else {
                $v['see_time'] = 0;
                $v['is_over']  = 0;
            }

            //章节为0的为总纲 不用转换
            if ($v['episode'] != 0) {
                $v['episode'] = '第' . numToWord($v['episode']) . '章';
            }

            //获取当前视频信息
            if ($chapter_id != null) {
                if ($v['id'] == $chapter_id) {
                    $video = $v;
                }
            }
        }

        //第一个视频的视频信息
        if ($chapter_id == null) {
            $video = $data[0];
        }

        //判断当前课程是否加入了学习计划
        if ($userClassModel->where('class_id=' . $class_id . ' AND uid=' . $uid)->find()) {
            $is_study = 1;
        } else {
            $is_study = 0;
        }

        //更新最后一次观看时间
        $userClassModel->where('class_id=' . $class_id . ' AND uid = ' . $uid)->setField('last_time', time());

        return ['code' => 1, 'msg' => '', 'data' => ['is_study' => $is_study, 'video' => $video, 'introduce' => $introduce, 'data' => $data]];
    }

    /**
     *
     * 加入学习计划
     *
     * @param $uid      int 用户id
     * @param $class_id int 课程id
     *
     *
     */
    public function addStudy($uid, $class_id)
    {
        $db = Db::name('UserClass');
//        if(db('UserClass')->where(['uid'=>$uid,'class_id'=>$class_id])->find()){
        if ($db->where(['uid' => $uid, 'class_id' => $class_id])->find()) {
            return ['code' => 1,'status'=>2, 'msg' => '当前课程已在学习计划中！'];
        }

        $id = $db->data(['uid' => $uid, 'class_id' => $class_id, 'last_time' => time(), 'ctime' => time()])->insert();
        if ($id) {
            return ['code' => 1,'status'=>1, 'msg' => '恭喜您，加入成功！'];
        } else {
            return ['code' => 0,'status'=>3, 'msg' => '很抱歉，加入失败，请稍后再试！'];
        }
    }

    /**
     *
     * 记录观看时间
     *
     */
    public function saveTime($uid, $chapter_id, $class_id, $currentTime)
    {

        $userChapterModel  = Db::name('user_chapter');
        $userClassModel    = Db::name('user_class');
        $classChapterModel = Db::name('class_chapter');

        //视频时长
        $info = $classChapterModel->field('name,vtime')->where('id=' . $chapter_id)->find();
        #正负5秒都算看完
        $time = $currentTime - $info['vtime'];
        //判断视频本次是否看完 1看完 0未看完
        if ($time >= -5 || $time >= 0) {
            $is_over = 1;
            //判断本视频之前是否积分
            $userScoreModel = model('home/UserScore');
            $name           = $info['name'];

            //积分 +2
            if (!$userScoreModel->where("name = '$name' AND type = 2 AND uid = $uid")->find()) {
                $userScoreModel->addScore($uid, $name, 2);
            }
        } else {
            $is_over = 0;
        }

        //判断该课程是否加入学习计划
        if ($userClassModel->where('class_id=' . $class_id . ' AND uid=' . $uid)->find()) {
            $is_study = 1;
        } else {
            $is_study = 0;
        }
        //判断之前是否观看过 未观看  直接入库  已观看 更新观看时间
        $chapterInfo = $userChapterModel->field('id,is_over')->where('uid=' . $uid . ' AND chapter_id=' . $chapter_id)->find();
//        dump($chapterInfo);
//        die();
        if ($chapterInfo) {
            //判断之前是否看完 若已看完，只需更新本次观看时间
            if ($chapterInfo['is_over'] == 0) {
                //是否加入学习计划  若加入过并且视频已看完，需要更新完成课时
                if ($is_study == 1) {
                    $userChapterModel->where('id=' . $chapterInfo['id'])->update(['see_time' => $currentTime, 'is_over' => $is_over]);
                    if ($is_over == 1) {
                        //完成一个课时
                        $userClassModel->where('class_id=' . $class_id . ' AND uid=' . $uid)->setInc('over_period');
                    }
                } else {
                    $userChapterModel->where('id=' . $chapterInfo['id'])->update(['see_time' => $currentTime, 'is_over' => $is_over]);
                }
            } else {
                $userChapterModel->where('id=' . $chapterInfo['id'])->update(['see_time' => $currentTime]);
            }
        } else {
            //是否加入学习计划
            if ($is_study == 1) {
                $userChapterModel->data(['uid' => $uid, 'chapter_id' => $chapter_id, 'see_time' => $currentTime, 'is_over' => $is_over])->insert();
                if ($is_over == 1) {
                    //完成一个课时
                    $userClassModel->where('class_id=' . $class_id . ' AND uid=' . $uid)->setInc('over_period');
                }
            } else {
                $userChapterModel->data(['uid' => $uid, 'chapter_id' => $chapter_id, 'see_time' => $currentTime])->insert();
            }
        }

//        $sql = "select a.id,a.name,a.thumb,a.episode,a.path,a.vtime,b.see_time,b.is_over from c_class_chapter as a left join c_user_chapter as b on a.id = b.chapter_id where b.uid= $uid and b.chapter_id =  $chapter_id";
//        Clas::query($sql)

        return ['code' => 1, 'msg' => '记录时间成功'];
    }

}