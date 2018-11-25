<?php

namespace app\branchadmin\controller;

use think\Controller;
use think\Request;

class Auth extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //关闭临时公共模板
        $this->view->engine->layout(false);
        //查询权限表(c_auth)的数据
        $list=\app\branchadmin\model\Auth::select();
        //var_dump($list);die;
        $list=getTree($list);
        return view('index',['list'=>$list]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //关闭临时公共模板
        $this->view->engine->layout(false);
        //查询所有一级权限，用于下拉列表展示
        $auth = \app\branchadmin\model\Auth::where('pid', 0)->select();
        return view('create', ['auth' => $auth]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //接收数据
        $data = $request->param();
        //检测参数格式
        //定义验证规则
        $rule=[
            'auth_name'=>'require',
            'auth_c'   =>'alpha',
            'auth_a'   =>'alpha',
        ];

        //定义提示信息
        $msg=[
            'auth_name.require' =>'权限名称不能为空',
            'cuth_c.require'    =>'控制器不能为空',
            'cuth_c.alpha'      =>'只能是字母',
            'cuth_a.require'    =>'控制器不能为空',
            'cuth_a.alpha'      =>'只能是字母',
        ];
        //实例化验证类
        $validata=new \think\validate($rule,$msg);
        //执行验证
        if (!$validata->check($data)) {
            $error = $validata->getError();
            $this->error($error);
        }
        //将控制器名称和方法名称，转化为固定的大小写格式，比如全小写
        $data['auth_c'] = strtolower($data['auth_c']);
        $data['auth_a'] = strtolower($data['auth_a']);
        //添加数据到权限表
        \app\branchadmin\model\Auth::create($data, true);
        //页面跳转
        $this->success('操作成功', 'index');
    }
    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //关闭临时模板
        $this->view->engine->layout(false);
        //根据$id查询一条数据
        $list=\app\branchadmin\model\Auth::find($id);
        //查询所有一级权限，用于下拉列表展示
        $auth = \app\branchadmin\model\Auth::where('pid', 0)->select();
//         dump($list['is_nav']);
        return view('edit',['list'=>$list,'auth'=>$auth]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //接收数据
        $data=$request->param();
//        dump($data);
//        die;
        //使用update函数更新数据

        \app\branchadmin\model\Auth::update($data, ['id' => $id], true);
        //页面跳转
        $this->success('更新成功', 'index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //删除权限
        \app\branchadmin\model\Auth::destroy($id);
        $this->success('删除成功','index');
    }
}