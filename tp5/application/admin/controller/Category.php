<?php

namespace app\admin\controller;

use app\admin\common\Base;
use app\admin\model\Category as CategoryModel;

class Category extends Base
{
	public function index()
	{
		//获取分类信息,显示层级
		$cate = CategoryModel::getCate();
		//获取分类信息，每页显示10条
		$cate_list = CategoryModel::paginate(3);
		$count = CategoryModel::count();
		//模板赋值
		$this->assign('cate',$cate);
		$this->assign('count',$count);
		$this->assign('cate_list',$cate_list);
		//模板渲染
		return $this -> fetch('category');
	}
	
}