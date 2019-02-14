<?php
namespace app\index\controller;


use app\index\model\User;

class Login
{
    public function index()
    {
        return view('index');
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
}
