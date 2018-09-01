<?php


// 应用公共文件

//function imageOper($image)
    //{
     //   $image->crop(100, 100);//裁剪
     //   return $image;
        // $image->thumb(150, 150)->save('./thumb.png');//生成缩略图
        // $image->thumb(150,150,\think\Image::THUMB_CENTER)->save('./thumb.png');//居中裁剪生成缩略图
        // // 给原图左上角添加水印并保存water_image.png,透明度50
        // $image->water('./logo.png',\think\Image::WATER_NORTHWEST,50)->save('water_image.png');
        // //复制一个字体文件HYQingKongTiJ.ttf,生成一个像素20px，颜色为#ffffff的文字水印
        // $image->text('十年磨一剑 - 为API开发设计的高性能框架','HYQingKongTiJ.ttf',20,'#ffffff')->save('text_image.png');
    //}


    /*
* 发送邮件
* @param $to string 要发送的邮箱地址
* @param $title string 邮件标题
* @param $content string 邮件内容
* @return bool
* */

function sendMail($to, $title, $content) {

$mail = new \phpmailer\PHPMailer(); //实例化
$mail->IsSMTP(); // 启用SMTP
$mail->Host=config('MAIL_HOST'); //smtp服务器的名称（这里以163邮箱为例）
$mail->SMTPAuth = config('MAIL_SMTPAUTH'); //启用smtp认证
$mail->Username = config('MAIL_USERNAME'); //发件人邮箱名
$mail->Password = config('MAIL_PASSWORD') ; //163邮箱发件人授权密码
$mail->From = config('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
$mail->FromName = config('MAIL_FROMNAME'); //发件人姓名
$mail->AddAddress($to,"尊敬的用户您好");
$mail->WordWrap = 50; //设置每行字符长度
$mail->IsHTML(config('MAIL_ISHTML')); // 是否HTML格式邮件
$mail->CharSet=config('MAIL_CHARSET'); //设置邮件编码
$mail->Subject =$title; //邮件主题
$mail->Body = $content; //邮件内容
$mail->AltBody = "邮件验证，请用网页打开"; //邮件正文不支持HTML的备用显示
return($mail->Send());
}