<?php

namespace app\branchadmin\controller;

use think\Db;
use think\Request;

include EXTEND_PATH . '/WeChatDeveloper/include.php';

class Weixin extends Base
{
    public $branch = [];
    public $rand   = []; //随机数数组

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $branch     = db('branch')->select();
        $this->rand = array_merge(range("A", "Z"), range("a", "z"), range(0, 9));
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //关闭临时模板
        $this->view->engine->layout(false);
        #测试svn
        //查询wixin表的所有数据
        $list = \app\branchadmin\model\Weixin::select();

//       dump($res);die;
        return view('index', ['list' => $list]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //关闭临时模板
        $this->view->engine->layout(false);
        $id  = session('branchadmin_info.id');
<<<<<<< HEAD
        $res = Db::name('branch_admin')->where('id', $id)->field('appid,appsecret,token,branchs_id')->find();
        $res['url'] = "https://api.cloudcpc.com/index/index/link?id=".$res['branchs_id'];
=======
        $res = Db::name('branch_admin')->where('id', $id)->field('appid,appsecret,token')->find();

>>>>>>> 785d9aef838ee57f91184b4930cfeff4e8641118
        //print_r($role_name);die;
        return view('create', ['res' => $res]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     *
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //接收数据
        $data = $request->param();

        //把当前毫秒生成的随机数存入$data中
//        $data['rand'] = $this->geturlnonce();

        //定义验证规则
        $rule = [
            'appid'     => 'require',
            'appsecret' => 'require',
            'token'     => 'require',
        ];

        //定义提示信息
        $msg = [
            'appid.require' => 'appid不能为空',
            'appsecret'     => 'appsecret不能为空',
            'token'         => 'token不能为空',
        ];
        //实例化验证类
        $validata = new \think\validate($rule, $msg);
        //执行验证
        if (!$validata->check($data)) {
            $error = $validata->getError();
            $this->error($error);
        }
        //把数据添加到数据库
//        \app\branchadmin\model\Weixin::create($data, true);
        $id  = session('branchadmin_info.id');
        $res = Db::name('branch_admin')->where('id', $id)->update($data);
<<<<<<< HEAD
//        dump($res);
//        die();
=======
        dump($res);
        die();
>>>>>>> 785d9aef838ee57f91184b4930cfeff4e8641118
        //页面跳转
        //$this->success('添加成功','index');
        $this->redirect('index');
    }

    public function check($id)
    {
        //关闭临时模板
        $this->view->engine->layout(false);
        $res = \app\branchadmin\model\Weixin::find($id);
        //判断token是否为空
        if (empty($res["check_token"])) {
            $check_token = 'weixin';
            db('weixin')->where(["id" => $id])->update(["check_token" => $check_token]);
            $res["check_token"] = $check_token;
        }

        //判断aeskey是否为空
        if (empty($res["check_aeskey"])) {
            $check_aeskey = $this->getnonce(25);
            db('weixin')->where(["id" => $id])->update(["check_aeskey" => $check_aeskey]);
            $res["check_aeskey"] = $check_aeskey;
        }
        //判断地址是否为空
        if (empty($res["check_url"])) {
            $res["check_url"] = Config("check_url");
            //查找当前验证的公众号的随机数
            $rand             = db('weixin')->where(['id' => $id])->field('rand')->find();
            $res["check_url"] .= '/' . $rand['rand'];
        }

        return view('check', ['res' => $res]);
    }

    //随机生成随机数
    public function getnonce($length = 8)
    {
        $token     = "";
        $token_arr = $this->rand;
        shuffle($token_arr);
        $count = count($token_arr);
        for ($i = 0; $i <= $length; $i++) {
            $index = rand(0, $count - 1);
            $token .= $token_arr[$index];
        }

        return $token;
    }

    //用当前毫秒拼接随机数
    function geturlnonce()
    {
        $time = microtime(true);
        $str  = $time . $this->getnonce(8);

        return md5($str);
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     *
     * @return \think\Response
     */

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     *
     * @return \think\Response
     */
    public function edit($id)
    {
        //关闭临时模板
        $this->view->engine->layout(false);
        //根据$id查询weixin表的一条数据
        $list = \app\branchadmin\model\Weixin::find($id)->toArray();
//        dump($list);
//        die;
        //根据$list['company_id']查询公司表的一条数据
        $pany = \app\branchadmin\model\Company::where('id', $list['company_id'])->find();
        //print_r($pany);die;
        //查询支部管理员表pid为0,所有company_id数据
//        $com=\app\branchadmin\model\BranchAdmin::where('pid',0)->field('company_id')->select()->toArray();
//        $comid=[];
//        foreach ($com as $key=>$value)
//        {
//            foreach ($com[$key] as $subkey=>$subv){
//                $comid[]=$subv;
//            }
//
//        }
//        $comid=implode(',',$comid);
//        //根据$comid查询company表的数据
//        $cmy=\app\branchadmin\model\Company::where('id','in',$comid)->select()->toArray();
        $cmy = \app\branchadmin\model\Company::select();
        // print_r($cmy);die;
        //查询微信表的（role_id）查询role表的一条数据
        $role  = \app\branchadmin\model\Role::where($list['role_id'])->find();
        $roles = \app\branchadmin\model\Role::all();

        return view('edit', ['list' => $list, 'cmy' => $cmy, 'pany' => $pany, 'role' => $role, 'roles' => $roles]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int            $id
     *
     * @return \think\Response
     */
    //更新党支部数据
    public function update(Request $request, $id)
    {
        //接收数据
        $data               = $request->param();
        $data['company_id'] = $data['0'];
        unset($data['0']);

        //使用update函数更新数据
        \app\branchadmin\model\Weixin::update($data, ['id' => $id], true);
        //页面跳转
        $this->redirect('index');
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
        \app\branchadmin\model\Weixin::destroy($id);
        $this->redirect('index');
    }

    /**
     * @menu   微信菜单栏目管理
     * @author : Mr_peng
     * @return
     */
    public function menu()
    {
        //关闭临时模板
        $this->view->engine->layout(false);
<<<<<<< HEAD
        $id  = session('branchadmin_info.company_id');
//        dump(session('branchadmin_info'));
//        dump($id);
//        die;

=======
        $id  = session('branchadmin_info.id');
>>>>>>> 785d9aef838ee57f91184b4930cfeff4e8641118
        $res = Db::name('menu')->where('company_id', $id)
            ->where('p_lv_id', 0)
            ->field('id,menu_name')
            ->select();
//        dump($res);
//        die();
        return view('menu', ['res' => $res]);
    }

    /**
     * @save_menu 新增微信菜单栏
     *
     * @param \think\Request $request
     *
     * @author    : Mr_peng
     * @return
     */
    public function save_menu(Request $request)
    {
        #获取数据
        $data = $request->param();
        if ($data['lv_fri'] == '1') {
            unset($data['lv_sec']);
            $data['menu_lv'] = $data['lv_fri'];
            $data['p_lv_id'] = 0;
            unset($data['lv_fri']);
        } elseif ($data['lv_fri'] == '2') {
            $data['menu_lv'] = $data['lv_fri'];
            $data['p_lv_id'] = $data['lv_sec'];
            unset($data['lv_sec']);
            unset($data['lv_fri']);
        }
        $data['ctime'] = time();
        #获取支部管理员id存入微信菜单表
        $info               = session('branchadmin_info');
        $data['company_id'] = $info['company_id'];

        //定义验证规则
        $rule = [
            'menu_lv'          => 'require',
            'p_lv_id'          => 'require',
            'menu_name'        => 'require',
            'menu_description' => 'require',
        ];

        //定义提示信息
        $msg = [
            'menu_lv'           => '请选择菜单层级',
            'p_lv_id'           => '请选择菜单层级',
            'menu_name.require' => '菜单栏名称',
            'menu_description'  => '菜单栏描述不能为空',
        ];
        //实例化验证类
        $validata = new \think\validate($rule, $msg);
        //执行验证
        if (!$validata->check($data)) {
            $error = $validata->getError();
            $this->error($error);
        }
//        dump($data);
//        die();
        //把数据添加到数据库
        $db_obj = Db::name('menu')->insert($data);
        //页面跳转
        if (!$db_obj) {
            $error = '菜单创建失败';
            $this->error($error);
        }
        //$this->success('添加成功','index');
        $this->redirect('menuindex');
    }

    /**
     * @menuindex 微信菜单列表
     * @author    : Mr_peng
     * @return
     */
    public function menuindex()
    {
        //关闭临时模板
        $this->view->engine->layout(false);
        $info       = session('branchadmin_info');
        $company_id = $info['company_id'];
        //查询wixin表的所有数据
        $list = Db::name('menu')->where(['company_id' => $company_id])->select();

//       dump($list);die;
        return view('menuindex', ['list' => $list]);
    }

    /**
     * @edit_menu  渲染修改页面
     *
     * @param $id
     *
     * @author     : Mr_peng
     * @return
     */
    public function edit_menu($id)
    {
        //关闭临时模板
        $this->view->engine->layout(false);
        //根据$id查询weixin表的一条数据
        $list = Db::name('menu')->find($id);

        $info       = session('branchadmin_info');
        $company_id = $info['company_id'];
        $res        = Db::name('menu')->where('company_id', $company_id)
            ->where('p_lv_id', 0)
            ->field('id,menu_name')
            ->select();

        //查询微信菜单表的（menu）查询menu表的一条数据
        return view('menu', ['list' => $list, 'res' => $res]);
    }

    /**
     * @update_menu  修改菜单内容
     *
     * @param \think\Request $request
     *
     * @author       : Mr_peng
     * @return
     */
    public function update_menu(Request $request)
    {
        //接收数据
        $data = $request->param();
        if ($data['lv_fri'] == '1') {
            unset($data['lv_sec']);
            $data['menu_lv'] = $data['lv_fri'];
            $data['p_lv_id'] = 0;
            unset($data['lv_fri']);
        } elseif ($data['lv_fri'] == '2') {
            $data['menu_lv'] = $data['lv_fri'];
            $data['p_lv_id'] = $data['lv_sec'];
            unset($data['lv_sec']);
            unset($data['lv_fri']);
        }
        $data['ctime'] = time();
        #获取支部管理员id存入微信菜单表
        $info               = session('branchadmin_info');
        $data['company_id'] = $info['company_id'];

        //定义验证规则
        $rule = [
            'menu_lv'          => 'require',
            'p_lv_id'          => 'require',
            'menu_name'        => 'require',
            'menu_description' => 'require',
        ];

        //定义提示信息
        $msg = [
            'menu_lv'           => '请选择菜单层级',
            'p_lv_id'           => '请选择菜单层级',
            'menu_name.require' => '菜单栏名称',
            'menu_description'  => '菜单栏描述不能为空',
        ];
        //实例化验证类
        $validata = new \think\validate($rule, $msg);
        $id       = $data['id'];
        unset($data['id']);
//        dump($data);
//        die();
//        //使用update函数更新数据
        $res = Db::name('menu')->where('id', $id)->update($data);
//        //页面跳转
        if (!$res) {
            $error = '菜单修改失败';
            $this->error($error);
        }
        //$this->success('添加成功','index');
        $this->redirect('menuindex');
    }

    /**
     * @delete_menu  删除菜单
     *
     * @param \think\Request $request
     *
     * @author       : Mr_peng
     * @return
     */
    public function delete_menu(Request $request)
    {
        $data = $request->param();
        $id   = $data['id'];
        $res  = \db('menu')->delete($id);
        if (!$res) {
            $error = '菜单删除失败';
            $this->error($error);
        }
        $this->redirect('menuindex');
    }

    /**
     * @create_menu  向微信端提交创建菜单请求
     *
     * @param \think\Request $request
     *
     * @author       : Mr_peng
     * @return
     */
    public function create_menu(Request $request)
    {
        $data     = $request->param();
        $id       = session('branchadmin_info.id');
        $password = encrypt_password($data['pass']);
        $where    = [
            'id'               => $id,
            'bradmin_password' => $password,
        ];
        $obj      = Db::name('branch_admin');
        $info     = $obj->where($where)->find();
        //判断结果
        if (!$info) {
            return '2';#密码错误
        }

        //拼接创建菜单参数
        $arr = Db::name('menu')->where('company_id', $id)->select();
        //一级菜单
        foreach ($arr as $k => $v) {
            if ($v['p_lv_id'] == 0) {
                $button[$v['id']] = [
                    'button' => [
                        $v['p_lv_id'] => [
                            'name' => $v['menu_name'],
                        ],
                    ],
                ];
                unset($arr[$k]);
            }
        }

        //二级菜单
        $i = 0;
        foreach ($arr as $arr_v) {
            foreach ($button as $k => $btn_v) {
                if ($arr_v['p_lv_id'] == $k) {
                    $button[$k]['button'][0]['sub_button'][$i] =
                        [
                            'tyep' => 'view',
                            'name' => $arr_v['menu_name'],
                            'url'  => $arr_v['menu_url'],
                        ];
                }
            }
            $i++;
        }
        unset($i);

        //最终菜单的格式结构
        $i = 0;
        foreach ($button as $key => $value) {
            $res_arr['button'][$i] = $value['button'][0];
            $i++;
        }
        unset($i);

        //获取 appid appsecret
        $config['appid']     = $info['appid'];
        $config['appsecret'] = $info['appsecret'];
        try {
            // 实例对应的接口对象
            $meau = new \WeChat\Menu($config);
            // 调用接口对象方法
            $res = $meau->create($res_arr);

            // 处理返回的结果
            dump($res);
        } catch (Exception $e) {

            // 出错
            echo $e->getMessage() . PHP_EOL;
        }
    }

    /**
     * @select_menu  添加菜单时的检查
     *
     * @param \think\Request $request
     *
     * @author       : Mr_peng
     * @return
     */
    public function select_menu(Request $request)
    {
        $data = $request->param();

        $info       = session('branchadmin_info');
        $company_id = $info['company_id'];
        if (!empty($data['lv_one'])) {
            $where = ['company_id' => $company_id, 'p_lv_id' => 0];
        } else {
            $where = ['company_id' => $company_id, 'p_lv_id' => $data['lv_sec']];
        }
        $count = Db::name("menu")->where($where)->count();

        return $count;
    }

<<<<<<< HEAD


    /**
     * 微信配置验证url
     *
     * @return bool
     */
    public function link()
    {
        header("Content-type: text/html; charset=utf-8");
//        $id  = session('branchadmin_info.id');
        $data      = $_GET; #接入验证
        $signature = $data['signature'];
        $timestamp = $data['timestamp'];
        $nonce     = $data['nonce'];
        $echostr   = $data['echostr'];
        $id   = $data['id'];

        $token =  Db::name('branch_admin')->where(['id'=> $id,'pid'=>0])->value('token');
        //计算微信签名
//        $token = 'smile_pengchang';
        //将参数组成一维数组
        $signeSeed = [$token, $timestamp, $nonce];
        //对参数字典序排序
        sort($signeSeed, SORT_STRING);
        //拼接成字符串
        $signeStr = implode($signeSeed);
        //加密字符串成签名
        $signeHash = sha1($signeStr);

        if ($signeHash == $signature) {
            echo $echostr;
        } else {
            return false;
        }
    }
=======
>>>>>>> 785d9aef838ee57f91184b4930cfeff4e8641118
}
