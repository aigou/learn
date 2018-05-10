<?php 

namespace app\admin\common;

use app\admin\model\System;
use think\Request;
use think\Controller;

class Base extends Controller
{
	protected function _initialize()
	{
		parent::_initialize();
		//在公共模块初始化方法中，创建常量判断是否登陆
		define('USER_ID',session('user_id'));

		//获取网站配置信息
		$config = $this->getSystem();

		//获取请求信息
		$request = Request::instance();

		//查询当前网站是否关闭
		$this -> getStatus($request,$config);

	}
	//判断用户是否登陆
	protected function isLogin()
	{
		if(is_null(USER_ID)){
			$this->error('未登录，无权访问·····','login/index');
		}
	}
	//如果用户已登录，不允许重复登录
	protected function alreadyLogin()
	{
		if (!is_null(USER_ID)) {
			$this->error('请不要重复登录·····','index/index');
		}
	}
	//获取配置信息
	public function getSystem()
	{
		return System::get(1);
	}
	//判断前台开启状态,获取请求对象和所有配置信息
	public function getStatus($request,$config)
	{
		//关闭得是前台
		if($request->module() != 'admin'){
			//根据配置表中的is_close 来判断，若为1，开启   若为0，关闭
			if($config->is_close == 0){
				$this->error('网站已关闭');
				exit();
			}
		}
	}
} 