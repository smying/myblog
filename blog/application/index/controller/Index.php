<?php
namespace app\index\controller;

class Index extends Nav
{
    public function index()
    {
    	$artres= \think\Db::name('article')->alias('a')->join('cate c','c.ID = a.cateid','LEFT')->field('a.id,a.title,a.pic,a.time,a.desc,a.click,a.like,a.keywords,c.catename')->order('a.id desc')->paginate(2);
    	$this->assign('artres',$artres);
        return $this->fetch();
    }

    public function login()
    {
    	if(request()->isPost()){
    		$data = [
    			'email' => input('email'),
    			'password'=>input('password'),
    		];
    		$rsu= \think\Db::name('user')->where('email',$data['email'])->find();
            if($rsu){
               if(($rsu['password']) === md5($data['password']))
               {
               		session(null);              
	                \think\Session::set('id',$rsu['id']);
                	\think\Session::set('username',$rsu['username']);
                	
               		// $remember = input('remember');
               		// if($remember == 1)
               		// {
               		// 	cookie('remember_username', trim($rsu['username']),3600*24*7);
               		// 	cookie('remember_password', trim($rsu['password']),3600*24*7);
               		// }
               		

                	return $this->success('登录成功',url('index'));
                	// redirect(U('index'));
               }else{
               		return $this->error('密码错误');
               }
		
            }else{
                return $this->error('用户不存在');
            }
        }
        return $this->fetch();
    }
    public function register()
    {
    	if(request()->isPost()){
    		$data = [
    			'email' => input('email'),
    			'username' => input('username'),
    			'password'=>input('password'),
    			'accept' => input('accept'),
    			'__token__'=> request()->token(),
    		];			
    		$emailcode = input('emailcode');
    		// if(!session('emailcode'))
    		// {
    		// 	$this->error('验证码未发送或已过期');
    		// }
    		// if($emailcode == session('emailcode'))
    		// {
    		// 	$this->success('邮箱验证成功');
    		// }
    		// else{
    		// 	$this->error('邮箱验证码错误！');
    		// }
    		if(!cookie('emailcode'))
    		{
    			$this->error('验证码未发送或已过期');
    		}
    		if($emailcode != cookie('emailcode'))
    		{
    			$this->error('邮箱验证码错误！');
    		}

    		$code = input('code');
			$rsu= \think\Db::name('user')->where('username',$data['username'])->find();
			$countu = count($rsu);
			if($countu){
				$this->error('用户名已被注册！');
			}
			if (!captcha_check($code)) {
            	$this->error('验证码错误');
        	}
        	if($data['accept'] != 1)
        	{
        		$this->error('请先同意服务条款');
        	}
    		$validate = \think\Loader::validate('User');
    		if($validate->check($data)){
    			unset($data['accept']);
    			unset($data['__token__']);
    			cookie('emailcode',null);
    			$data['password'] = md5($data['password']);
    			$data['create_time'] = date('Y-m-d H:i:s',time());
    			$res = \think\Db::name('user')->insert($data);
    			$userId = \think\Db::name('user')->getLastInsID();
    			if($res){
    				session(null);              
	                \think\Session::set('id',$userId);
                	\think\Session::set('username',$data['username']);
	                return $this->success('注册成功','index');
	            }else{
	                return $this->error('注册失败');
	            }
    		
    		}else{
                return $this->error($validate->getError());
            }			    
    	}
    	return $this->fetch();
    }
    public function logout(){
	    session(null);//退出清空session
	    return $this->success('退出成功',url('login'));//跳转到登录页面
    }
    public function confirmEmail($email)
    {
    	cookie(['prefix' => '', 'expire' => 3600]);
    	$code = mt_rand(1000,9999);
    	cookie('emailcode',$code, 300);//验证码五分钟失效
    	// \think\Session::set('emailcode',$code);
    	sendMail('1320151286@qq.com','博客注册验证码',$code.'<br>五分钟有效');
    }

    public function check($username){
    	$info = db('user')->where('username','=',$username)->find();
    	if($info){
    		echo '该用户名已被注册';
    	}else{
    		echo '该用户名可用';
    	}
    	exit;
    }
}
