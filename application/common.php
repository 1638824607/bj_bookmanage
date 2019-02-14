<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function dd($data)
{
    echo '<pre>';
    var_dump($data);
    die;
}

function email_send($toemail, $subject, $emailCode)
{
    $mail = new \phpmailer\PHPMailer();
    $mail->isSMTP();
    $mail->CharSet = "utf8";
    $mail->Host = "smtp.163.com";
    $mail->SMTPAuth = true;
    $mail->Username = "17180101405@163.com";
    $mail->Password = "shen159539";
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->setFrom("17180101405@163.com","图书管理系统");
    $mail->addAddress($toemail);
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = "亲爱的用户：<br>您好！<br>您的验证码是：{$emailCode}<br>本邮件是系统自动发送的，请勿直接回复！";

    if(!$mail->send()){
        return $mail->ErrorInfo;
    }else{
        return 1;
    }
}
