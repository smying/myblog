<?php
namespace app\admin\validate;
 
use think\Validate;
 
class Admin extends Validate
{
    //验证规则
    protected $rule = [
        'username'  =>  'require|max:25|unique:admin',
        'password' => 'require|min:5',
        // '__token__' => 'token',
    ];
 
    //验证提示
    protected $message  =   [
        'username.unique' => '管理员名称不能重复', 
        'username.max' => '管理员名称不能大于25个字符',
        'username.require' => '管理员名称必须填写',
        'password.require' => '管理员密码必须填写',
        'password.min' => '管理员密码不能少于5位',
    ];
}