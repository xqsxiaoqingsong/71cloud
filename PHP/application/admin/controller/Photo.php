<?php
/**
 * Created by PhpStorm.
 * User: lwen_phper@163.com
 * Date: 2018/7/10
 * Time: 11:30
 *
 * 党建相册
 *
 */
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
class Photo extends Base{
    /**
     *
     * 相册列表
     *
     */
    public function index(){
        $logmin = strtotime(trim(input('get.logmin')));
        $logmax = strtotime(trim(input('get.logmax')));
        $name = trim(input('get.name'));

        $map = [];
        $map['is_del'] = 0;
        //日期筛选
        if($logmin && $logmax){
            $map['ctime'] = ['between',"$logmin,$logmax"];
        }

        //名称筛选
        if($name){
            $map['name'] = ['LIKE',"%$name%"];
        }

        //党建相册
        $data = db('Photo')->field('id,name,ctime')->where($map)->select();

        //数据总数量
        $count = count($data);

        $this->assign('count',$count);
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 添加相册
     *
     */
    public function add(){
        if(Request::instance()->isGet()){

            return $this->fetch();
        }else{
            $name = trim(input('post.name'));
            $content = trim(input('post.content'));

            if(empty($name) || empty($content)){
                return json(['code' => 0,'msg' => '请将信息填写完整！']);
            }

            if(empty($_FILES)){
                return json(['code' => 0,'msg' => '请至少上传一张图片！']);
            }

            //检测重名
            $photoModel = db('Photo');
            if($photoModel->where("name = '$name'")->find()){
                return json(['code' => 0,'msg' => '名称重复！']);
            }

            //开启事务
            db() -> startTrans();

            //数据入库
            $id = $photoModel ->insert([
                'name'      =>  $name,
                'content'   =>  $content,
                'ctime'     =>  time(),
            ]);
            //获取插入数据的id
            $photo_id=$photoModel ->getLastInsID();


            /*-------多图片上传开始--------*/
            $files = request()->file('path');

                foreach($files as $file){
                    // 移动到框架应用根目录/public/uploads/ 目录下
                    $info = $file->move(ROOT_PATH . 'public' . '/' . 'Uploads');

                    if($info){
                        //获取图片路径并把路径从'\'转换成'/'
                        $getSaveName=str_replace("\\","/",$info->getSaveName());
                        //获取图片路径
                        $path = '/'.'Uploads'.'/'.$getSaveName;
                        $data[]= [
                          'photo_id' => $photo_id,
                          'path' => $path,
                        ];

                    }else{
                      // 上传失败获取错误信息
                     return json(['code'=>0,'msg'=>'上传失败!']);
                    }
                }
            /*-------多图片上传结束--------*/

            $res = db('PhotoImg') -> insertAll($data);

            if(!$res){
                return json(['code' => 0,'msg' => '图片上传失败！']);
            }

            if($id && $res){
                //成功
                db() -> commit();
                return json(['code' => 1,'msg' => '添加成功！']);
            }else{
                //失败
                db() -> rollback();
                return json(['code' => 0,'msg' => '添加失败！']);
            }

        }
    }



    /**
     * 编辑相册
     * @param       $id     int     相册id
     *
     */
    public function edit(){
        $id = intval(input('request.id'));
        if($id <= 0){
            return json(['code' => 0,'msg' => '参数错误！']);
        }

        if(Request::instance()->isGet()){

            //产品信息
            $data['info'] = db('Photo') ->field('id,name,content') -> where('id = '.$id) -> find();
            $data['info']['content'] = htmlspecialchars_decode($data['info']['content']);//转义

            //相册
            $data['img'] = db('PhotoImg') -> field('id,path') -> where('photo_id = '.$id) -> select();

            $this->assign('data',$data);
            return $this->fetch();
        }else{

            $name = trim(input('post.name'));
            $content = trim(input('post.editorValue'));

            if(empty($name) || empty($content)){
                return json(['code' => 0,'msg' => '请将信息填写完整！']);
            }

            //检测重名
            $photoModel = db('Photo');
            if($photoModel->where("name = '$name' AND id != $id")->find()){
                return json(['code' => 0,'msg' => '名称重复！']);
            }


            /*-------多图片上传开始--------*/

                $files = request()->file('path');

                foreach($files as $file){
                    // 移动到框架应用根目录/public/uploads/ 目录下
                    $info = $file->move(ROOT_PATH . 'public' . '/' . 'Uploads');

                    if($info){
                        //获取图片路径并把路径从'\'转换成'/'
                        $getSaveName=str_replace("\\","/",$info->getSaveName());
                        //获取图片路径
                        $path = '/'.'Uploads'.'/'.$getSaveName;
                        $data[]= [
                            'photo_id'=>$id,
                            'path' => $path,
                        ];
                        $res = db('PhotoImg') -> insertAll($data);

                        if(!$res){
                            return json(['code' => 0,'msg' => '图片上传失败！']);
                        }
                    }else{
                        // 上传失败获取错误信息
                        echo $file->getError();
                    }
                }

            /*-------多图片上传结束--------*/


            //数据修改
             $photoModel->where('id = '.$id)->update([
                'name'      =>  $name,
                'content'   =>  $content,
            ]);


            return json(['code' => 1,'msg' => '修改成功！']);



        }


    }


    /**
     * 图库查看
     * @param       $id     int     相册id
     *
     */
    public function show(){
        $id = intval(input('get.id'));
        if($id <= 0){
            return json(['code' => 0,'msg' => '参数错误！']);
        }

        $data = db('PhotoImg') -> where('photo_id = '.$id) -> select();

        $this->assign('data',$data);
        return $this->fetch();


    }


    /**
     * 删除照片
     * @param      $img_id       int        相册中照片id
     *
     */
    public function img_del(){
        $img_id = intval(input('post.img_id'));
        if($img_id <= 0){
            return json(['code' => 0,'msg' => '参数错误!']);
        }
        db('PhotoImg') -> where('id = '.$img_id) -> delete();

        return json(['code' => 1,'msg' => '删除成功!']);

    }


    /**
     *
     * 新闻删除
     * @param          $id        int       新闻id
     *
     *
     */
    public function del(){
        $id = intval(input('post.id'));
        if($id <= 0){
            return json(['code' => 0,'msg' => '参数错误！']);
        }


        db('Photo') -> where('id = '.$id) -> setField(['dtime' => time(),'is_del' => 1]);
        return json(['code' => 1,'msg' => '删除成功！']);


    }






}