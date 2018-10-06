<?php
namespace app\index\controller;
class Search extends Nav
{
    public function index()
    {
    	$keywords=input('keywords');//获取搜索关键词
    	if($keywords){
    		$map['title']  = ['like','%'.$keywords.'%'];//关键词模糊搜索语句
    		$seares=\think\Db::name('article')->where($map)->order('id desc')->paginate(2);//查询和分页
    		$this->assign('seares',$seares);//模板赋值
    		$this->assign('keywords',$keywords);
    	}else{
    		$this->assign('keywords','没有关键词');//没有关键词的情况处理
    		$this->assign('seares',null);
 
    	}
        return $this->fetch('search');
    }
    public function showContact($keywords)
    {
        if($keywords){
            $map['title']  = ['like','%'.$keywords.'%'];
            $seares=\think\Db::name('article')->where($map)->order('id desc')->find();
            return json($seares['title']);

        }else{
            $map['title']  = ['like','%'.$keywords.'%'];
            $seares=\think\Db::name('article')->order('id desc')->limit(5);
            return ['title'=>$seares['title']];//返回title，返回对象在页面上显示
        }
    }
}