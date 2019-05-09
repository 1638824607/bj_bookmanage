<?php
namespace app\index\controller;

use app\index\model\Site;
use app\index\model\User;
use phpmailer\PHPMailer;

class System extends Base
{
    public function site_form()
    {
        $site = new Site();

        $siteRow = $site->find();

        return view('site_form', [
            'siteRow' => $siteRow
        ]);
    }

    public function site_save()
    {
        $siteRow = input('post.');

        $site = new Site();

        if(empty($siteRow['site_id']))
        {
            $site->create($siteRow);
        }else{
            $site->save($siteRow, ['site_id' => $siteRow['site_id']]);
        }

        return ['code' => 1, 'msg' => '保存成功'];
    }

    public function pass_form()
    {
        return view('pass_form');
    }

    public function pass_save()
    {
        $userPass = trim(input('user_pass'));

        if(empty($userPass)) {
            return ['code' => 0, 'msg' => '请输入密码！'];
        }

        $userId = session('user_info')['user_id'];

        $user = new User();

        $user->save(['user_pass' => md5($userPass)], ['user_id' => $userId]);

        return ['code' => 1, 'msg' => '更改成功！'];
    }

    public function email_form()
    {
        return view('email_form');
    }

    public function email_save()
    {
        $userEmail = trim(input('user_email'));
        $emailCode = trim(input('email_code'));

        if(empty($userEmail) || empty($emailCode)) {
            return ['code' => 0, 'msg' => '请输入邮箱或验证码！'];
        }

        if(session('bind_email_code') != $emailCode) {
            return ['code' => 0, 'msg' => '邮箱验证码错误！'];
        }

        if(session('bind_email') != $userEmail) {
            return ['code' => 0, 'msg' => '发送邮箱与输入邮箱不一致！'];
        }

        $userId = session('user_info')['user_id'];

        $user = new User();

        $userRow = $user->where('user_email', $userEmail)->find();

        if(! empty($userRow))
        {
            if($userRow['user_id'] == $userId) {
                return ['code' => 0, 'msg' => '检测邮箱一致，无需变更！'];
            }else {
                return ['code' => 0, 'msg' => '该邮箱已存在，请重新输入！'];
            }
        }

        $user->save(['user_email' => $userEmail], ['user_id' => $userId]);

        $userInfo = session('user_info');

        $userInfo['user_email'] = $userEmail;

        session('user_info', $userInfo);
        session('bind_email_code', NULL);
        session('bind_email', NULL);

        return ['code' => 1, 'msg' => '更改成功！'];
    }

    public function send_email()
    {
        $userEmail = trim(input('user_email'));

        if(empty($userEmail)) {
            return ['code' => 0, 'msg' => '请输入邮箱！'];
        }

        $emailCode = mt_rand(1000, 9999);

        $res = email_send($userEmail, '绑定邮箱验证码', $emailCode);

        if($res !== 1) {
            return ['code' => 0, 'msg' => '发送验证码失败，请重试'];
        }

        session('bind_email_code', $emailCode);
        session('bind_email', $userEmail);

        return ['code' => 1, 'msg' => '发送验证码成功'];
    }
}
