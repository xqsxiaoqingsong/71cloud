<?php
/**
 * Created by PhpStorm.
 * User: lwen_phper@163.com
 * Date: 2018/7/17
 * Time: 8:58
 *
 * 新闻模型
 *
 */
namespace app\home\model;

use think\Model;

class News extends Model{

    /**
     *
     * 获取推荐新闻
     * @param       $son_cate       array       党建要闻所有子分类
     *
     */
    public function getRecommendNews($son_cate){

        $map = [];
        $map['is_del'] = 0;
        $map['recommend'] = 1;
        $map['cate_id'] = ['IN',$son_cate];

        $recommend = $this-> field('id,title,content,thumb') -> where($map) -> limit(3) -> order('ctime desc') -> select();

        return $recommend;

    }

    /**
     *
     * 党建新闻列表
     * @param $cate_id int 分类id
     * @param $p int 页码
     * @param $pageSize int 页长
     *
     */
    public function getPartyNewsList($cate_id = null,$p,$pageSize){

        $map = [];
        $map['is_del'] = 0;
        $recommend=array();
//        $res=db('ContentNewClass')->select();

        if($cate_id == null || $cate_id == 'all'){
            $son_cate = getSon($this->getNewsCate($type=1),1);

            $map['cate_id'] = ['IN',$son_cate];
            //首页需要获取推荐新闻
            if($p == 1){
                $recommend = $this -> getRecommendNews($son_cate);
            }
        }else{
            $map['cate_id'] = $cate_id;
        }
        //获取分页数据
        $news = $this
            -> field('id,title,thumb,ctime,content')
            -> where($map)
            -> order('ctime desc')
            -> page($p,$pageSize)
            -> select();
        //数据格式化
        foreach ($news as &$v){
            $v['content'] = convertContent($v['content']);
            $v['ctime'] = date('Y-m-d', $v['ctime']);
        }

        return ['news'=>$news,'recommend'=>$recommend];


    }




    /**
     *
     * 反腐倡廉新闻列表
     *
     *
     */
    public function getClearNewsList($cate_id = null,$p,$pageSize){
        //新闻
        $map = [];
        $map['a.is_del'] = 0;
        //首页需要所有子分类数据
        if($cate_id == null || $cate_id == 'all'){
            $son_cate = getSon($this->getNewsCate($type=2),2);
            $map['a.cate_id'] = ['IN',$son_cate];
        }else{
            $map['a.cate_id'] = $cate_id;
        }

        //获取分页数据
        $news = db('news') ->alias('a')
            -> field('a.id,a.title,a.thumb,a.ctime,b.name')
            -> join('c_new_cate b','a.cate_id = b.id')
            -> where($map)
            -> order('a.ctime desc')
            -> page($p,$pageSize)
            -> select();

        //数据格式化
        foreach ($news as &$v){
            $v['ctime'] = date('Y-m-d H:i:s',$v['ctime']);
        }

        return $news;

    }


    /**
     *
     * 新闻分类
     * @param $type 类型 1表示党建要闻 2表示反腐倡廉
     *
     */
    public function getNewsCate($type){

        if($type == 1){
            $data = db('NewCate')->field('id,pid,name')->where('pid = 1')->select();
        }else{
            $data = db('NewCate')->field('id,pid,name')->where('pid = 2')->select();
        }

        return $data;
    }


    /**
     *
     * 新闻详情页
     * @param $id int 新闻id
     * @param $uid int 用户id 非必须
     *
     */
    public function getDetail($id){
        $data = db('news') -> field('title,content,praise,ctime') -> where('id = '.$id) -> find();

        //点赞人数
        $name = $data['title'];
        $uids = db('UserScore')->field('uid')->where("name = '$name' AND type = 1")->select();
        foreach ($uids as $k => $v){
            $uids[$k] = $v['uid'];
        }
        $data['count'] = count($uids);

        $uid = cookie('user')['id'];
        //点赞状态 0未点赞 1已点赞
        if(empty($uid)){
            $data['status'] = 0;
        }else{
            in_array($uid,$uids) ? $data['status'] = 1 : $data['status'] = 0;
        }

        $data['content'] = htmlspecialchars_decode($data['content']);

        return $data;
    }




}