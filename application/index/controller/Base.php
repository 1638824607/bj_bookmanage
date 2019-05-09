<?php
namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    private $userUrlList = [
        'book/book_user_list',
        'lend/lend_user_list',
        'system/pass_form',
        'system/pass_save',
        'system/email_form',
        'system/email_save',
        'system/send_email',
        'index/index',
        'home/site_info',
        'book/book_table',
        'lend/lend_user_table',
        'lend/lend_user_add',
        'lend/lend_user_book',
        'lend/lend_user_status',
        'lend/lend_user_repay'
    ];

    public function __construct()
    {
        parent::__construct();

        $userInfo = session('user_info');

        if(empty($userInfo)) {
            $this->redirect(url('login/index'));
        }

        $currentUrl = request()->controller() . '/' . request()->action();

        if((! in_array(strtolower($currentUrl), $this->userUrlList)) && ($userInfo['user_type'] == 1)) {
            $this->redirect(url('index/index'));
        }
    }
}
