<?php
namespace app\admin\controller;
class User extends Basic
{
	public function users()
	{
		$users = \think\Db::name('user')->select();
		$this->assign('users',$users);
		return $this->fetch('userlists');
	}
}