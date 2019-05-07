<?php
namespace app\index\controller;

use app\index\model\User;
use think\Controller;

class Login extends Controller
{
    public function index()
    {
        if(! empty(session('user_info'))){
            $this->redirect(url('/'));
        }
        return view('index');
    }

    public function forget_pass(){
        return view('forget_pass');
    }

    public function login()
    {
        $userName = input('user_name');
        $userPass = input('user_pass');

        $user = new User();

        $userRow = $user->where('user_name', $userName)->where('user_pass', md5($userPass))->find();

        if(empty($userRow)) {
            return ['code' => 0, 'msg' => '账号或密码错误,请重试!'];
        }

        if($userRow['user_status'] == 1) {
            return ['code' => 0, 'msg' => '该账号已被屏蔽,请联系管理员！'];
        }

        session('user_info', $userRow->toArray());

        $saveData = [
            'last_ip' => $_SERVER['REMOTE_ADDR'],
            'last_time' => date('Y-m-d H:i:s')
        ];

        $user->save($saveData, ['user_id' => $userRow['user_id']]);

        return ['code' => 1, 'msg' => '登录成功'];
    }

    public function logout()
    {
        session('user_info', NULL);

        return ['code' => 1, 'msg' => '注销成功'];
    }

    public function send_email()
    {
        $userEmail = trim(input('user_email'));

        if(empty($userEmail)) {
            return ['code' => 0, 'msg' => '请输入邮箱！'];
        }

        $emailCode = mt_rand(1000, 9999);

        $res = email_send($userEmail, '忘记密码', $emailCode);

        if($res !== 1) {
            return ['code' => 0, 'msg' => '发送验证码失败，请重试'];
        }

        session('forget_email_code', $emailCode);
        session('forget_email', $userEmail);

        return ['code' => 1, 'msg' => '发送验证码成功'];
    }

    public function renew_pass()
    {
        $userEmail  = trim(input('user_email'));
        $emailCode  = intval(input('email_code'));
        $userPass   = trim(input('user_pass'));
        $userRepass = trim(input('user_repass'));

        if(empty($userEmail) || empty($emailCode) || empty($userPass) || empty($userRepass)) {
            return ['code' => 0, 'msg' => '输入异常,请重新输入！'];
        }

        if($userPass != $userRepass) {
            return ['code' => 0, 'msg' => '两次密码不一致，请重新输入！'];
        }

        if(session('forget_email_code') != $emailCode) {
            return ['code' => 0, 'msg' => '邮箱验证码错误！'];
        }

        if(session('forget_email') != $userEmail) {
            return ['code' => 0, 'msg' => '发送邮箱与输入邮箱不一致！'];
        }

        $user = new User();

        $userRow = $user->where('user_email', $userEmail)->find();

        if(empty($userRow)) {
            return ['code' => 0, 'msg' => '邮箱不存在，请重新输入！'];
        }

        $user->save(['user_pass' => md5($userPass)], ['user_email' => $userEmail]);

        session('forget_email_code', NULL);
        session('forget_email', NULL);

        return ['code' => 1, 'msg' => '找回密码成功！'];
    }
}
