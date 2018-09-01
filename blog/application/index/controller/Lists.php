<?php
namespace app\index\controller;
class Lists extends Nav
{
	public function index()
	{
		$cates = \think\Db::name('cate')->field('catename')->find(input('cateid'));
		$catename = $cates['catename'];
		$articles = \think\Db::name('article')->order('id desc')->where('cateid',input('cateid'))->paginate(2);
		$this->assign('articles',$articles);
		$this->assign('catename',$catename);
		return $this->fetch('lists');
	}
}