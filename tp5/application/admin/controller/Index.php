<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Db;

class Index extends Base
{
	public function index()
	{
		$this->isLogin();
		return $this -> fetch('index') ;
	}
	public function welcome()
	{
		return $this -> fetch('welcome') ;
	}
	
}
