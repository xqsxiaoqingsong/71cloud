<?php
/**
 * Created by PhpStorm.
 * User: lwen_phper@163.com
 * Date: 2018/8/13
 * Time: 8:37
 *
 * 用户积分模型
 *
 */
namespace app\home\model;

use think\Model;

class UserScore extends Model{

    /**
        积分规则
        点赞了“xxxxxxx” +1分（文章） new_id
        学习了“xxxxxxx” +2分（视频） class_chapter_id
        一颗红心投稿，+2分
        投稿被采用，+10分
        参加在线考试，成绩优异；+10分
        参加了“xxxxxxxx”（活动），+5分

        规则：
        1、点赞、学习、投稿每日积分累计相加不大于10分，当日超过部分不在计入积分。
        2、考试成绩大于90分为优异，同一张试卷只计算一次积分。
        3、投稿被采用和参加活动积分不受限制
    */


    /**
     *
     * @param $uid int 用户id
     * @param $name string 加分项目名称 如文章标题、视频名称、投稿稿件名称、考试名称、活动名称
     * @param $type int 加分类型 1点赞 2学习视频 3投稿 4投稿被采用 5参加考试成绩优异 6参加活动
     *
     *
     */
    public function addScore($uid,$name,$type){
        //判断得分
        switch ($type){
            case 1:
                $score = 1;
                break;
            case 2:
                $score = 2;
                break;
            case 3:
                $score = 2;
                break;
            case 4:
                $score = 10;
                break;
            case 5:
                $score = 10;
                break;
            case 6:
                $score = 5;
        }

        //点赞、学习、投稿每日积分累计相加不大于10分，当日超过部分不在计入积分。
        if($type == 1 || $type == 2 || $type == 3){
            $map = [];
            //今日时间范围
            $today_start = mktime(0,0,0,date('m'),date('d'),date('Y'));
            $today_end   = mktime(23,59,59,date('m'),date('d'),date('Y'));

            $map['ctime'] = ['between',"$today_start,$today_end"];
            $map['type'] = ['between',"1,3"];
            $map['uid'] = $uid;
            //今日总分
            $today_total_score = $this->where($map)->column('SUM(score)');
            $today_total_score = $today_total_score[0];

            $this->data(['uid'=>$uid,'name'=>$name,'type'=>$type,'score'=>$score,'ctime'=>time()]);
            $res = $this->save();

           if($today_total_score + $score  > 10){
               return ['code'=>0,'msg'=>'点赞、学习、投稿今日积分已达上限,上限为10分','data'=>''];
           }

        }



        return ['code'=>1,'msg'=>'积分成功','data'=>''];

    }

    /**
     *
     * 积分明细
     *
     * 1点赞 2学习视频 3投稿 4投稿被采用 5参加考试成绩优异 6参加活动
     */
    public function getScoreDetail($uid,$p,$pageSize,$time =null){

        //日期筛选 12 1 6 ''
        if($time != null){

            $time = explode('-',$time);
            $year = $time[0];
            $month = $time[1];

            $start = mktime(0,0,0,date($month),1,date($year));
            $end = mktime(23,59,59,date($month),date('t'),date($year));

        }else{
            $start = mktime(0,0,0,date('m'),1,date('Y')); //本月开始
            $end = mktime(23,59,59,date('m'),date('t'),date('Y')); //本月结束
        }

        $map['ctime'] = ['between',"$start,$end"];
        $map['uid'] = $uid;
        $data = $this->where($map)->order('ctime desc')->page($p, $pageSize)->select();

//        dump(UserScore::getLastSql());
//        dump($data);
        //总积分
        $total_score = $this->sum('score');

        foreach ($data as &$v){
            //积分类型
            switch ($v['type']){
                case 1:
                    $v['type'] = '点赞';
                    break;
                case 2:
                    $v['type'] = '学习视频';
                    break;
                case 3:
                    $v['type'] = '投稿';
                    break;
                case 4:
                    $v['type'] = '投稿被采用';
                    break;
                case 5:
                    $v['type'] = '参加考试成绩优异';
                    break;
                case 6:
                    $v['type'] = '参加活动';
            }

            $v['ctime'] = date('Y-m-d',$v['ctime']);
//            $total_score = $total_score + $v['score'];
        }

//        /*//数组截取
//        if($time != null){
//            $data = array_slice($data,($p-1)*$pageSize,$pageSize);
//        }*/

        return ['data'=>$data,'total_score'=>$total_score];

    }


}