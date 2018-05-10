<?php

namespace app\admin\controller;

use app\admin\model\System as SystemModel;
use app\admin\common\Base;
use think\Request;

class System extends Base
{
	public function index()
	{
		$system = SystemModel::get(1);
		$this->assign('system',$system);
		return $this -> fetch('system_list');
	}
	public function update(Request $request)
	{
		if($request->isAjax()){
			$data = $request->param();
			$map =['is_update' => $data['is_update']];
			$res = SystemModel::update($data,$map);
			if($res){
				$status = 1;
				$message = '修改成功';
			}else{
				$status = 0;
				$message = '修改失败';
			}
		}else{
			$status = 0;
			$message = '修改失败';
		}
		return json(['status' => $status , 'message' => $message]);
	}
}


