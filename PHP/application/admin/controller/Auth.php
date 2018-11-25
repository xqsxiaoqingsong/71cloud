<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;

class Auth extends Base
{
    /**
     * 用户后台权限管理
     *
     * @return \think\Response
     */
    public function index()
    {
        //关闭临时公共模板
        $this->view->engine->layout(false);
        //查找总数据
        $num=db('auth')->count();

        //查询权限表(c_auth)的数据
        $list=\app\branchadmin\model\Auth::select();
        //var_dump($list);die;
        $list=getTree($list);
        //调用无极分类方法，在顶级分类前面加上‘|--’便于区分
        $auth_name=$this->getCategory();

        return view('index',['list'=>$list,'auth_name'=>$auth_name,'num'=>$num]);
    }

    //无极分类显示
    public function getCategory($category =array(),$pid =0,$k=0){
        $dingji = db("auth")->where(array("pid"=>$pid))->select();
        foreach($dingji as  $v){
            $str =  "<span style='color:red'>";
            for($i=0;$i<$k;$i++){
                $str.="|--";
            }
            $str.="</span>";
            $str.=$v["auth_name"];

            $v["auth_name"] = $str;
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
    public function create()
    {
        //关闭临时公共模板
        $this->view->engine->layout(false);
        //查询所有一级权限，用于下拉列表展示
        $auth = \app\branchadmin\model\Auth::where('pid', 0)->select();


        return view('auth/create', ['auth' => $auth]);
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


        //查询当前修改的数据
        $res=db('auth')->where(array('id'=>$id))->field('company_id,is_nav,id,auth_name')->find();

        //根据当前修改的id找顶级
        $pid=db("auth")->where(array('id'=>$id))->field('pid,id')->find();

        if($pid['pid']!=0){
            $rows=db('auth')->where(array('id'=>$pid['pid']))->field('id,auth_name')->find();
        }else{
            $rows=db("auth")->where(array('id'=>$id))->field('id,auth_name')->find();
        }

        return view('edit',['list'=>$list,'auth'=>$auth,'res'=>$res,'rows'=>$rows]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update()
    {
        $id=input('id');

        $data=input('post.');

        if($id==$data['pid']){
            $data['pid']=0;
        }

        db('auth')->where(array('id'=>$id))->update($data);
        //页面跳转
        $this->success('更新成功', 'index','','1');
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
        $this->success('删除成功','index','','1');
    }

    /**
     * 权限与公司的绑定
     */
    public function binding(){
        if(Request::instance()->isGet()){
        //查所有公司
        $company=db('company')->field('id,company_name')->select();

        //查找已经绑定的公司id
        $cid=db('auth_company')->distinct("company_id")->column('company_id');
        $cid = implode(",",$cid);
        $name=db('company')->where(array('id'=>array('not in',$cid)))->field('id,company_name')->select();

        //查所有顶级权限
        $auth=db('auth')->where('pid=0')->field('id,auth_name')->select();

        $this->assign('name',$name);
        $this->assign('auth',$auth);
        }else{
            $data=input('post.');
            $data['auth_id']=implode(',',$data['auth_id']);
            $result=db('auth_company')->insert(['company_id'=>$data['pid'],'auth_id'=>$data['auth_id'],'ctime'=>time()]);
            if($result){
                return json(['code'=>1,'msg'=>'绑定成功']);
            }else{
                return json(['code'=>1,'msg'=>'绑定失败']);
            }
        }
        return $this->fetch('auth/update');
    }


}
