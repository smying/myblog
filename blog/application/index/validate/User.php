<?php
namespace app\index\validate;
 
use think\Validate;
 
class User extends Validate
{
    //验证规则
    protected $rule = [
        'username'  =>  'require|max:25|unique:user|chsDash',
        'password' => 'require|min:5',
        'email'  => 'require|email|unique:user',
        '__token__' => 'token',
    ];
 
    //验证提示
    protected $message  =   [
        'username.unique' => '用户名已被注册', 
        'username.max' => '用户名不能大于25个字符',
        'username.require' => '用户名必须填写',
        'username.chsDash' => '用户名必须为汉字字母数组下划线或破折号',
        'password.require' => '密码必须填写',
        'password.min' => '密码不能少于5位',
        'email.email' => '邮箱格式不对',
        'email.require' => '邮箱必须填写',
        'email.unique' => '邮箱已被注册',
    ];
}