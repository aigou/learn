<?php

namespace app\admin\controller;

use app\admin\common\Base;

class Article extends Base
{
	public function index()
	{
		return $this -> fetch('article_list');
	}
	public function delete()
	{
		return $this -> fetch('article_del');
	}
}
