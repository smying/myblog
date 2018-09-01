<?php
namespace app\index\Controller;
use think\Controller;
class Basic extends Controller
{
	public function _initialize()
	{
		if(!session('id')){
			return $this->error('请先登录',url('Index/login'));
		}
	}

}