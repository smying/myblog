<?php
namespace app\index\controller;
class Guest extends Nav
{
    public function index()
    {
    	
    	if(request()->isPost()){
    		$data=[
    			'nickname'=>input('inpName'),
    			'homepage'=>input('inpHomePage'),
    			'email'=>input('inpEmail'),
    			'content'=>input('txaArticle'),
    			'time'=>time(),
    		];
    		if(\think\Db::name('guest')->insert($data)){
    			return $this->redirect('Guest/index');
    		}else{
    			return $this->redirect('Guest/index');
    		}
    		return;
    	}
 
    	$guestres=\think\Db::name('guest')->select();
    	$this->assign('guestres',$guestres);
        return $this->fetch('guest');
    }
}