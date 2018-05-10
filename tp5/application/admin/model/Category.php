<?php

namespace app\admin\model;

use think\Model;
use think\Collection;

class Category extends Model
{
    //创建静态方法获取分类信息
   	/**
   	 * @param int $pid ;当前父Id
   	 * @param arrray $result ;引用返回值
   	 * @param int $blank ;设置分类层次显示
   	 */
    public static function getCate($pid=0,&$result=[],$blank=0)
    {
    	//分类查询；$pid
    	$res = self::all(['pid' => $pid]);

    	//自定义分类名称前面的提示信息+空格
    	$blank+=2;

    	//遍历分类表
    	foreach ($res as $key => $value) {
    		//自定义显示格式
    		$cate_name = '--'.$value->cate_name;
    		$value->cate_name = str_repeat('&nbsp',$blank).$cate_name;


    		$result[] = $value;
    		self::getCate($value->id,$result,$blank);
    	}
    	//转换为二维数组
    	return Collection::make($result)->toArray();
    }
}
