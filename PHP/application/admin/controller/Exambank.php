<?php
namespace app\admin\controller;
use think\Request;

class Exambank extends Base{

    //题目首页
    public function index(){
        //接收搜索框传过来的值
        $content=input('get.content');
        //定义一个空数组放条件
        $map = [];

        //题目筛选
        if($content){
            $map['content'] = ['LIKE',"%$content%"];
        }
        //查找题目
        $question=db('exam_questions')
            ->field('id,content,opt1,opt2,opt3,opt4,answer_k,answer_v,create_time')
            ->where($map)
            ->select();
        //题目总数
        $count = count($question);
        $this->assign('count',$count);
        $this->assign('question',$question);
        return $this->fetch('exambank/index');
    }



    //题目添加
    public function add(){
        if(Request::instance()->isGet()){
            //定义选项数组
            $opt=[
                ['opt'=>'opt1'],
                ['opt'=>'opt2'],
                ['opt'=>'opt3'],
                ['opt'=>'opt4']
            ];
            $this->assign('opt',$opt);
        }else{
            $data = input('post.');

            //判断信息是否填写完整
            if (!$data['content'] || !$data['opt1'] || !$data['opt2'] || !$data['answer_k'] || !$data['answer_v']) {
                return json(['code' => 0, 'msg' => '请将信息填写完整！']);
            }

            $data['create_time'] = time();
            db('exam_questions')->insert($data);
            return json(['code' => 1, 'msg' => '添加成功!']);
        }
        return $this->fetch();

    }



    //题目修改
    public function edit(){
        //获取修改的id
        $id=input('id');
        if(Request::instance()->isGet()){
            //查找修改的数据
            $row=db('exam_questions')
                ->where(['id'=>$id])
                ->field('id,content,opt1,opt2,opt3,opt4,answer_k,answer_v')
                ->find();

            //定义选项数组
            $opt=[
                ['opt'=>'opt1'],
                ['opt'=>'opt2'],
                ['opt'=>'opt3'],
                ['opt'=>'opt4']
            ];
            $this->assign('opt',$opt);
            $this->assign('row',$row);
            return $this->fetch();
        }else{
            $data=input('post.');

            //判断信息是否填写完整
            if (!$data['content'] || !$data['opt1'] || !$data['opt2'] || !$data['answer_k'] || !$data['answer_v']) {
                return json(['code' => 0, 'msg' => '请将信息填写完整！']);
            }

            $data['update_time'] = time();
            db('exam_questions')->where(['id'=>$id])->update($data);
            return json(['code' => 1, 'msg' => '修改成功!']);
        }
        return $this->fetch();

    }

    //删除
    public function del(){
        //获取id
        $id=input('id');
        db('exam_questions')->where(['id'=>$id])->delete();
        return json(['code' => 1, 'msg' => '删除成功!']);
    }


}