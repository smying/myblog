<?php
namespace app\index\controller;
use app\index\model\CityStory as CityStorys;
class CityStory extends Nav
{
	public function add()
    {
        if(request()->isPost()){
            $storys = new CityStorys;
            $storys->data([
                'title'=>input('title'),
                'url'=>input('url'),
                'desc'=>input('desc'),
            ]);
            // $validate = \think\Loader::validate('CityStory');
            if($validate->check($storys)){
                if($storys->save()){
                    return $this->success('添加故事成功','lists');
                    // return ['success'=>false,'msg'=>'添加故事成功！'];
                }else{
                    return $this->error('添加故事失败');
                }
            }else{
                return $this->error($validate->getError());
            }
            return;
        }
        return $this->fetch();
    }
}