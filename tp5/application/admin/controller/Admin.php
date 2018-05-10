<?php

namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use app\admin\model\Admin as AdminModel;
use think\Session;

class Admin extends Base
{
	public function index()
	{
		$data = AdminModel::select()->toArray();
		$this->assign('data',$data);
		return $this -> fetch('admin_list');
	}
	public function edit(Request $request)
	{
		$data =AdminModel::get($request->get('id'));
		$this->assign('data',$data);
		return $this -> fetch('admin_edit');
	}
	public function update(Request $request)
	{
		if($request){
			$data = $request->param();
			//判断是否对本人操作
			//var_dump($data);
			$session = Session::get('user_info');
			//var_dump($session);
			if( $session->username == $data['username']){
				$res = AdminModel::update($data,['id',$data['id']]);
				if(!is_null($res)){
					$status = 1;
					$message = '修改成功';
				}else{
					$status = 0;
					$message = '修改成功';
				}
			}else{
				$status = 0;
				$message = '不是本人操作，拒绝执行';
			}
			
		}		
		return json(['status' => $status,'message' => $message]);
	}	
	public function rule()
	{
		return $this -> fetch('admin_rule');
	}
	public function role()
	{
		return $this -> fetch('admin_role');
	}
	public function cate()
	{
		return $this -> fetch('admin_cate');
	}
}
