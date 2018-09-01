<?php
namespace app\index\Controller;
use think\Controller;
class Nav extends Controller
{
	//定义控制器初始化方法_initialize，在该控制器的方法调用之前首先执行。
    public function _initialize()
    {
        $this->nav();
    }

	public function nav()
	{
		$navres = \think\Db::name('cate')->order('id asc')->select();
		$this->assign('navres',$navres);
	}
}
