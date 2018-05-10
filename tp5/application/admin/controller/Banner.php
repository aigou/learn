<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use think\Db;

class Banner extends Base
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		$data = Db::query('SELECT * FROM banner');
		$this->assign('data',$data);
		return $this -> fetch('banner_list');
	}

	/**
	 * [delete description]
	 * @return [type] [description]
	 */
	public function create()
	{
		return $this -> fetch('banner_add');
	}

	/**
	 * [save description]
	 * @return [type] [description]
	 */
	public function save(Request $request)
	{
		if($request->isPost()){
			//param(true)可以获得所有数据包括文件
			$data = $request->param(true);
			$file = $request->file('image');
			if(empty($file)){
				$this->error($file->getError());
			}else{
				//上传限制
				$map=[
					'ext'=>'jpg,png,gif,jpeg',
					'size'=>300000,
				];
				$info = $file->validate($map)->move(ROOT_PATH.'public/uploads');
				if(is_null($info)){
					$this->error('文件格式不支持');
				}else{
					$data['image'] = $info->getSaveName();
					$res = DB::execute("INSERT INTO banner(image,link,descr) VALUES(:image,:link,:descr)",[$data['image'],$data['link'],$data['descr']]);
					if($res){
						$this->success('添加成功');
					}
				}

			}
		}else{
			$this->error('请求类型错误......');		
		}
	}
	/**
	 * [delete description]
	 * @return [type] [description]
	 */
	public function delete()
	{
		return $this -> fetch('article_del');
	}
}
