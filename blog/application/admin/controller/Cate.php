<?php
namespace app\admin\controller;
class Cate extends Basic
{
    public function lists()
    {
        $lists = \think\Db::name('cate')->select();
		$this->assign('lists',$lists);
		return $this->fetch();
    }
 
    public function add()
    {
    	if(request()->isPost()){
            $data = [
                'catename'=>input('catename'),
                'keywords'=>input('keywords'),
                'desc'=>input('desc'),
                'type'=>input('type') ? input('type') : 0,//如果type为空则为0
            ];
            $validate = \think\Loader::validate('Cate');
            if($validate->check($data)){
                $res = \think\Db::name('cate')->insert($data);
                if($res){
                    return $this->success('添加栏目成功','lists');
                }else{
                    return $this->error('添加栏目失败');
                }
            }else{
                return $this->error($validate->getError());
            }
    		return;
    	}
        return $this->fetch();
    }

    public function edit()
    {
    	$id = input('id');
    	$cates = db('cate')->where('id',$id)->find();
    	$this->assign('cates',$cates);
    	if(request()->isPost()){
    		$data = [
    			'id'=>input('id'),
                'catename'=>input('catename'),
                'keywords'=>input('keywords'),
                'desc'=>input('desc'),
                'type'=>input('type') ? input('type') : 0,
    		];
    		$validate = \think\Loader::validate('Cate');
            if($validate->check($data)){
                $res = \think\Db::name('cate')->update($data);
                if($res){
                    return $this->success('修改栏目成功','lists');
                }else{
                    return $this->error('修改栏目失败');
                }
            }else{
                //验证失败输出提示信息
                return $this->error($validate->getError());
            }
        
    	}
        return $this->fetch();
    }

    public function del()
    {
        //获取模板传过来的id
        $id=input('id');
        //使用助手函数进行删除操作和判断
        if(db('cate')->delete($id)){
            return $this->success('删除栏目成功','lists');
        }else{
            return $this->error('删除栏目失败');
        }
    }
}