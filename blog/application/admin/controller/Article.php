<?php
namespace app\admin\controller;

class Article extends Basic
{
    public function lists()
    {
        $articles = \think\Db::name('article')->paginate(3);
		$this->assign('articles',$articles);
		return $this->fetch();
    }
 
    public function add()
    {
    	if(request()->isPost()){
            $data = [
                'title'=>input('title'),
                'cateid' => input('cateid'),
                'keywords'=>input('keywords'),
                'desc'=>input('desc'),             
                'content'=>input('content'),
                'time' => date('Y-m-d',time()),
            ];
            $data['author_id'] = session('id');
            //判断表单是否上传了文件
            if($_FILES['pic']['tmp_name']){
            	//获取表单上传的文件
                $file = request()->file('pic');
                
            	// 移动到框架应用根目录/public/uploads/ 目录下
            	$info = $file->validate(['ext'=>'jpg,png,gif,jpeg'])->move(ROOT_PATH.'public'.DS.'/static/uploads');
            	//上传后的文件保存在/public/static/uploads下
            	if($info){
            		//拼接文件路径
			        //使用date()方法计算出八位时间，上传到uploads的文件所在的文件名就是这八位时间
			        //使用$info->getFilename()方法获取文件名
            		$data['pic'] = '/static/uploads/'.date('Ymd').'/'.$info->getFilename();
                    //date,md5,sha1三种命名规则,获取散列值,$info->md5()
            	}else{
            		return $this->error($file->getError());
            	}
                $image = \think\Image::open('../public'.$data['pic']);
                $image->thumb(200, 200)->save('../public'.$data['pic']);//生成缩略图
            };
            
            $validate = \think\Loader::validate('Article');
            if($validate->check($data)){
                $res = \think\Db::name('article')->insert($data);
                if($res){
                    return $this->success('添加文章成功','lists');
                }else{
                    return $this->error('添加文章失败');
                }
            }else{
                return $this->error($validate->getError());
            }
    		return;
    	}
    	$cates = db('cate')->select();
    	$this->assign('cates',$cates);
        return $this->fetch();
    }

    public function edit()
    {
    	$id = input('id');
    	$articles = db('article')->where('id',$id)->find();
    	$this->assign('articles',$articles);

    	if(request()->isPost()){
            $data = [
            	'id' => input('id'),
                'title'=>input('title'),
                'cateid' => input('cateid'),
                'keywords'=>input('keywords'),
                'desc'=>input('desc'),             
                'content'=>input('content'),
                'time' => date('Y-m-d',time()),
            ];
            $data['author_id'] = session('id');
            //判断表单是否上传了文件
            if($_FILES['pic']['tmp_name']){
                $oldImg = db('article')->where('id',$data['id'])->find();
                unlink('../public'.$oldImg['pic']);//删除原来的图片文件
            	//获取表单上传的文件
            	$file = request()->file('pic');
                
            	// 移动到框架应用根目录/public/uploads/ 目录下
            	$info = $file->move(ROOT_PATH.'public'.DS.'/static/uploads');
            	//上传后的文件保存在/public/static/uploads下
            	if($info){
            		//拼接文件路径
			        //使用date()方法计算出八位时间，上传到uploads的文件所在的文件名就是这八位时间
			        //使用$info->getFilename()方法获取文件名
            		$data['pic'] = '/static/uploads/'.date('Ymd').'/'.$info->getFilename();
            	}else{
            		return $this->error($file->getError());
            	}
            };
            $validate = \think\Loader::validate('Article');
            if($validate->check($data)){
                $res = \think\Db::name('article')->update($data);
                if($res){
                    return $this->success('修改文章成功','lists');
                }else{
                    return $this->error('修改文章失败');
                }
            }else{
                return $this->error($validate->getError());
            }
    		return;
    	}
    	$cates = db('cate')->select();
    	$this->assign('cates',$cates);
        return $this->fetch();
    }


    public function del()
    {
        //获取模板传过来的id
        $id=input('id');
        $oldImg = db('article')->where('id',$data['id'])->find();
        unlink('../public'.$oldImg['pic']);//删除原来的图片文件
        //使用助手函数进行删除操作和判断
        if(db('article')->delete($id)){
            return $this->success('删除文章成功','lists');
        }else{
            return $this->error('删除文章失败');
        }
    }

    
}