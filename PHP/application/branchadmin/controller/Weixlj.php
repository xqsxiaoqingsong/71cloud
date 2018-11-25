<?php

namespace app\branchadmin\controller;

use think\Controller;
use think\Log;
use think\Request;

class Weixlj extends Controller
{
    const TOKEN = 'weixin';

    public function index()
    {
        //调用valid方法实现数据验证
        return $this->valid();
        $this->responseMsg();


    }

    private function valid()
    {
        $echoStr = isset($_GET["echostr"]) ? $_GET["echostr"] : '';

        //valid signature , option
        if($this->checkSignature() === true){
            Log::info('微信验证成功:'.$echoStr);
            return $echoStr;
        }
        return false;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function checkSignature()
    {
        // you must define TOKEN by yourself
        //判断TOKEN常量是否定义
        if (!self::TOKEN) {
            throw new \Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = self::TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg()
    {

        //get post data, May be due to the different environments
        //接收微信客户端发送过来的XML数据
        $postStr = file_get_contents("php://input");
        //extract post data
        //判断数据是否为空
        if (!empty($postStr)){

            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            //主要功能：防止XXE攻击
            libxml_disable_entity_loader(true);
            //对XML数据进行解析生成simplexml对象
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            //微信的客户端openid
            $fromUsername = $postObj->FromUserName;
            //微信公众平台
            $toUsername = $postObj->ToUserName;
            //微信客户端向公众平台发送的关键词
            $keyword = trim($postObj->Content);
            //时间戳
            $time = time();
            //调用$tmp_arr
            global $tmp_arr;
            //接收MsgType节点并判断其值
            switch($postObj->MsgType) {
                case 'text':
                    $msgType = "text";
                    $contentStr = "您发送的是文本消息！";
                    $resultStr = sprintf($tmp_arr['text'], $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    break;
                case 'image':
                    $msgType = "text";
                    $contentStr = "您发送的是图片消息！";
                    $resultStr = sprintf($tmp_arr['text'], $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    break;
                case 'voice':
                    $msgType = "text";
                    $contentStr = "您发送的是语音消息！";
                    $resultStr = sprintf($tmp_arr['text'], $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                    break;
                //...
                case 'event':
                    if($postObj->Event == 'subscribe') {
                        $msgType = "text";
                        $contentStr = "感谢您关注访友！";
                        $resultStr = sprintf($tmp_arr['text'], $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
                    }
                    break;
            }
        }else {
            echo "你你你";
            exit;
        }
    }





    private function xmls()
    {
        return <<<EOT
<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
<FuncFlag>0</FuncFlag>
</xml>'
EOT;
    }
}
