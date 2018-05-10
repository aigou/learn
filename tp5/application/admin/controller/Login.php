<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Session;
use think\Request;
use app\admin\model\Admin as AdminModel;
class Login extends Base
{
	//渲染登录页面
	public function index()
	{
		$this ->alreadyLogin();
		return $this -> fetch('login');
	}
	//验证登录身份
	public function check(Request $request)
	{
		//设置返回status
		$status = 0;

		//获取表单数据
		$data = $request -> param();
		$userName = $data['username'];
		$password = md5($data['password']);
		//测试数据
		// $userName = 'index';
		// $password = '111111';
		//echo AdminModel::get($userName);
		
		$result =AdminModel::where('username' ,$userName)->find();
		//在admin中进行查询是否存在该用户
		if(is_null($result)){
			$message = '该用户不存在';
		}elseif ($result['password'] != $password) {
			$message = '密码不正确，请重新输入密码';
		}else{
			//验证通过，修改状态信息以及更新数据
			$status = 1;
			$message = '登录成功';
			AdminModel::where('username' ,$userName)->setInc('login_count');
			AdminModel::where('username' ,$userName)->setField('last_time',time());
			 //保存信息到SESSION
			Session::set('user_id',$userName);
			Session::set('user_info',$result);
		}
		$arr = array(
			'status' => $status,
			'message' => $message,
		);
		return json($arr);
	}
	//退出登录
	public function logout()
	{
		//清除登陆的session
		session(null);
		//跳转回登录页面
		$this->success('注销成功，正在跳转...','login/index');
	}

}