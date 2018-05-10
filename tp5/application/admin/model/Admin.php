<?php 

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
	protected function getLasttimeAttr($val)
	{
		return date('Y-m-d',$val);
	}
	protected function setPasswordAttr($val)
	{
		return md5($val);
	}
}