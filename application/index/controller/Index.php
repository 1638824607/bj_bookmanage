<?php
namespace app\index\controller;


class Index extends Base
{
    public function index()
    {
        $userInfo = session('user_info');

        return view('index_'.$userInfo['user_type']);
    }

    public function book_rank()
    {
        return view('book_rank');
    }

    public function ajax_book_rank()
    {
        $lend = new \app\index\model\Lend();

        $thisWeekStart = date('Y-m-d ', strtotime('this week')) . '00:00:00';
        $thisWeekEnd   = date('Y-m-d ', strtotime('next week -1 day')) . '23:59:59';

        $thismonthStart = date('Y-m-01', time()) . ' 00:00:00';
        $thismonthEnd   = date('Y-m-d H:i:s', strtotime(date('Y-m-01', strtotime('+1 month')) . '00:00:00')-1);

        $lendWeekList = $lend->field("DAYOFWEEK(created_day) as week, count(lend_id) as lend_num")->where('created_at', '>=', $thisWeekStart)->where('created_at', '<=', $thisWeekEnd)
            ->group('created_day')->order('created_day', 'desc')->select();

        $lendMonthList = $lend->field("date_format(created_day,'%m/%d') as created_day, count(lend_id) as lend_num")->where('created_at', '>=', $thismonthStart)->where('created_at', '<=', $thismonthEnd)
            ->group('created_day')->order('created_day', 'asc')->select();

        $lendBookList = $lend->field('count(lend_id) as lend_num, book_name')->alias('lend')
            ->join('book_info book', 'book.book_cert = lend.book_cert')
            ->group('lend.book_cert')->order('lend_num', 'desc')->limit(30)->select();

        return [
            'lend_week'  => $lendWeekList,
            'lend_month' => $lendMonthList,
            'lend_book'  => $lendBookList,
        ];
    }

    public function user_rank()
    {
        return view('user_rank');
    }

    public function ajax_user_rank()
    {
        $lend = new \app\index\model\Lend();

        $thisWeekStart = date('Y-m-d ', strtotime('this week')) . '00:00:00';
        $thisWeekEnd   = date('Y-m-d ', strtotime('next week -1 day')) . '23:59:59';

        $thismonthStart = date('Y-m-01', time()) . ' 00:00:00';
        $thismonthEnd   = date('Y-m-d H:i:s', strtotime(date('Y-m-01', strtotime('+1 month')) . '00:00:00')-1);

        $lendWeekList = $lend->field("count(lend_id) as lend_num, user_nickname")->alias('lend')
            ->join('user_info user', 'user.user_name = lend.user_name')
            ->where('lend.created_at', '>=', $thisWeekStart)->where('lend.created_at', '<=', $thisWeekEnd)
            ->group('lend.user_name')->order('lend_num', 'desc')->limit(30)->select();

        $lendMonthList = $lend->field("count(lend_id) as lend_num, user_nickname")->alias('lend')
            ->join('user_info user', 'user.user_name = lend.user_name')
            ->where('lend.created_at', '>=', $thismonthStart)->where('lend.created_at', '<=', $thismonthEnd)
            ->group('lend.user_name')->order('lend_num', 'desc')->limit(30)->select();

        $lendBookList = $lend->field("count(lend_id) as lend_num, user_nickname")->alias('lend')
            ->join('user_info user', 'user.user_name = lend.user_name')
            ->group('lend.user_name')->order('lend_num', 'desc')->limit(30)->select();

        return [
            'lend_week'  => $lendWeekList,
            'lend_month' => $lendMonthList,
            'lend_book'  => $lendBookList,
        ];
    }
}
