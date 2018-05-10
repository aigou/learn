<?php

namespace app\index\controller;

use app\admin\common\Base;

class Index extends Base
{
    public function index()
    {
        // $return = Db::name('admin')->select();
        // var_dump($return);
        return'<h1>网站开启<h1>';
    }
}
