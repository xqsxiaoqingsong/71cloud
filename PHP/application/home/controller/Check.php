<?php
/**
 * Created by PhpStorm.
 * User: lwen_phper@163.com
 * Date: 2018/8/16
 * Time: 9:32
 *
 * 接口安全处理
 *
 */
namespace app\home\controller;

use think\Controller;
use think\Request;
class Check extends Controller{
    public $branch = array();
    public  $rand = array(); //随机数数组
    public function __construct()
    {
        $this->rand  = array_merge(range("a","z"),range(0,9));
    }
    /**
     *
     * @param $uid int 用户id
     * @param $timestamp string 当前时间戳
     * @param $encrypt string 加密字符串
     *
     *
     */
    public function checkCode($uid,$timestamp,$encrypt){
        //判断时间戳是否过期
        if(time() - $timestamp > 300){
            return false;
        }

        if($uid != 0){
            //登录状态
            $token = db('User')->where('id='.$uid)->cloumn('token');
            if(md5($uid.$timestamp.$token) == $encrypt){
                return true;
            }else{
                return false;
            }

        }else{

            //未登录状态
            $token = 'Guojidangjianyun2018';

            if(md5($uid.$timestamp.$token) == $encrypt){
                return true;
            }else{
                return false;
            }
        }


    }

    /**
     *
     * 获取随机token
     *
     */
    public function getToken($uid){


        $arr = array_merge(range(0,9),range('a','z'),range('A','Z'));
        $token = '';
        //32位随机串
        for($i=0;$i<32;$i++){
            $token .= $arr[rand(0,count($arr)-1)];
        }


        if( db('user')->where('id='.$uid)->setField('token',$token)){
            return $token;
        }else{
            return false;
        }


    }


    //随机生成随机数
    public function getnonce($length = 8){
        $token ="";
        $token_arr = $this->rand;
        shuffle($token_arr);
        $count = count($token_arr);
        for($i=0;$i<=$length;$i++){
            $index = rand(0,$count-1);
            $token.=$token_arr[$index];
        }
        return $token;
    }



}