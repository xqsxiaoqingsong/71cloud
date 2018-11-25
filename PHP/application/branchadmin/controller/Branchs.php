<?php

namespace app\branchadmin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Branchs extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    //党支部管理展示
    public function index()
    {
        //关闭临时模板
        $this->view->engine->layout(false);
        //查询支部表的所有数据
//        $company_id = session('branchadmin_info.company_id');
//        $list       = model('branchs')->where('company_id', $company_id)->select();
        //使用递归函数进行处理
//        $list = getTree($list);

        //调用无极分类方法，在顶级分类前面加上‘|--’便于区分
        $list=$this->getCategory();

        return view('index', ['list' => $list]);
    }

    //无极分类显示
    public function getCategory($category =array(),$pid =0,$k=0){
        $company_id = session('branchadmin_info.company_id');
        $dingji = Db::name("branchs")->where(["pid"=>$pid,'company_id'=>$company_id])->select();
        foreach($dingji as  $v){
            $str =  "<span style='color:red'>";
            for($i=0;$i<$k;$i++){
                $str.="|--";
            }
            $str.="</span>";
            $str.=$v["branchs_name"];

            $v["branchs_name"] = $str;
            $category[] = $v;

            $category = $this->getCategory($category,$v["id"],$k+1);
        }
        return $category;
    }


    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    //添加党支部操作
    public function create()
    {
        //关闭临时模板
        $this->view->engine->layout(false);
        $company_id = session('branchadmin_info.company_id');
        $where      = ['company_id' => $company_id];
        //查询所有一级权限，用于下拉列表展示
        $list = getTree(model('branchs')->where($where)->select()->toArray());
        //查询权限表（roles）所有数据
        $data = model('roles')->where($where)->select();

        return view('create', ['list' => $list, 'data' => $data]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     *
     * @return \think\Response
     */
    //接收添加党支部数据保持数据库
    public function save(Request $request)
    {
        //接收数据
        $data = $request->param();

//        $data['phone'] = (int) $data['phone'];
        //检测数据
        //定义验证规则
        $rule = [
            'branchs_name' => 'require',
//            'phone'        => 'require|max:11|number',
            'roles_id'     => 'require',
        ];

        //定义提示信息
        $msg = [
            'branchs_name.require' => '党支部名称不能为空',
//            'phone.require'        => '电话号码不能为空',
//            'phone.max'            => '电话号码最多不能超过11个字符',
//            'phone.number'         => '电话号码只能是数字',
            'roles_id.require'     => '必须选择角色',
        ];
        //实例化验证类
        $validata = new \think\validate($rule, $msg);
        //执行验证
        if (!$validata->check($data)) {
            $error = $validata->getError();
            $this->error($error);
        }
        //添加时间
        $data['ctime']      = time();
        $company_id         = session('branchadmin_info.company_id');
        $data['company_id'] = $company_id;
//        dump($data);die;
        //把数据添加到数据库
        \app\branchadmin\model\Branchs::create($data, true);
        //页面跳转
        $this->success('添加成功', 'index');
    }
    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     *
     * @return \think\Response
     */
    //修改党支部操作
    public function edit($id)

    {
        //关闭临时模板
        $this->view->engine->layout(false);
        //根据$id查询一条数据
//        $info = \app\branchadmin\model\Branchs::find($id);
        $company_id = session('branchadmin_info.company_id');
        $where['a.id'] = $id;
        $info =  Db::name('branchs')->alias('a')
            ->join('c_roles b','a.roles_id = b.id')
            ->where($where)
            ->field('a.branchs_name,a.id,a.phone,a.roles_id,b.roles_name')
            ->find();
//        dump($info);
        $roles_id = $info['roles_id'];
        $data =  Db::name('roles')->where("company_id = $company_id AND id != $roles_id")->field('id,roles_name')->select();
//        dump($data);
//        die();
        return view('edit', ['info' => $info,'data'=>$data]);
//        return view('edit', ['info' => $info]);
    }

    //更新党支部数据
    public function update(Request $request, $id)
    {
        //接收数据
        $data = $request->param();
        //使用update函数更新数据
        \app\branchadmin\model\Branchs::update($data, ['id' => $id], true);
        //页面跳转
        $this->success('更新成功', 'index');
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     *
     * @return \think\Response
     */
    public function delete($id)
    {
        //删除党支部
        \app\branchadmin\model\Branchs::destroy($id);
        $this->success('删除成功', 'index');
    }

    public function auth()
    {
        return '党支部权限';
    }
}