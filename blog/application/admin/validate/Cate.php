<?php
namespace app\admin\validate;
 
use think\Validate;
 
class Cate extends Validate
{
    //验证规则
    protected $rule = [
        // catename验证，必须，长度不能超过25，名称不能重复
        'catename'  =>  'require|max:25|unique:cate',
    ];
 
    //验证提示
    protected $message  =   [
        'catename.unique' => '栏目名称不能重复', 
        'catename.require' => '栏目名称必须',
        'catename.max' => '栏目名称不能大于5个字符',
        
    ];
}