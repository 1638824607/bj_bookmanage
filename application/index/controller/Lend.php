<?php
namespace app\index\controller;

use app\index\model\UserCate;

class Lend extends Base
{
    public function lend_list()
    {
        $cate   = new \app\index\model\Cate();
        $public = new \app\index\model\Publics();
        $place  = new \app\index\model\Place();

        $cateList = $cate->where('cate_status', 2)->column('*');

        $publicList = $public->where('public_status', 2)->column('*');
        $placeList  = $place->where('place_status', 2)->column('*');

        return view('lend_list', [
            'cateList'   => $cateList,
            'publicList' => $publicList,
            'placeList'  => $placeList
        ]);
    }

    public function lend_user_list()
    {
        $cate   = new \app\index\model\Cate();
        $public = new \app\index\model\Publics();
        $place  = new \app\index\model\Place();

        $cateList = $cate->where('cate_status', 2)->column('*');

        $publicList = $public->where('public_status', 2)->column('*');
        $placeList  = $place->where('place_status', 2)->column('*');

        return view('lend_user_list', [
            'cateList'   => $cateList,
            'publicList' => $publicList,
            'placeList'  => $placeList
        ]);
    }

    public function lend_user_table()
    {
        $limit = empty(intval(input('limit'))) ? 20 : intval(input('limit'));

        $bookCert     = empty(intval(input('book_cert'))) ? 0 : intval(input('book_cert'));
        $bookName     = empty(trim(input('book_name'))) ? '' : trim(input('book_name'));
        $lendStatus   = empty(intval(input('lend_status'))) ? 0 : intval(input('lend_status'));

        $whereArr = [
            'lend.user_name' => session('user_info')['user_name']
        ];

        if(! empty($bookCert)) {
            $whereArr['lend.book_cert'] = $bookCert;
        }

        if(! empty($bookName)) {
            $whereArr['book_name'] = $bookName;
        }

        if(! empty($lendStatus)) {
            $whereArr['lend_status'] = $lendStatus;
        }

        $lend = new \app\index\model\Lend();

        $lendList = $lend->field('lend.*, book_name,book_cate,book_public,book_place, user_nickname')->alias('lend')
            ->join('book_info book', 'lend.book_cert = book.book_cert')
            ->join('user_info user', 'user.user_name = lend.user_name')
            ->where($whereArr)
            ->order('lend_id', 'desc')
            ->paginate($limit);

        return [
            'code'  => 0,
            'count' => $lendList->total(),
            'data'  => $lendList->toArray()['data'],
            'msg'   => 'success'
        ];
    }

    public function lend_expired_list()
    {
        $cate   = new \app\index\model\Cate();
        $public = new \app\index\model\Publics();
        $place  = new \app\index\model\Place();

        $cateList = $cate->where('cate_status', 2)->column('*');

        $publicList = $public->where('public_status', 2)->column('*');
        $placeList = $place->where('place_status', 2)->column('*');

        return view('lend_expired_list', [
            'cateList' => $cateList,
            'publicList' => $publicList,
            'placeList' => $placeList
        ]);
    }

    public function lend_table()
    {
        $limit = empty(intval(input('limit'))) ? 20 : intval(input('limit'));

        $userName     = empty(trim(input('user_name'))) ? '' : trim(input('user_name'));
        $userNickName = empty(trim(input('user_nickname'))) ? '' : trim(input('user_nickname'));
        $bookCert     = empty(intval(input('book_cert'))) ? 0 : intval(input('book_cert'));
        $bookName     = empty(trim(input('book_name'))) ? '' : trim(input('book_name'));
        $lendStatus   = empty(intval(input('lend_status'))) ? 0 : intval(input('lend_status'));

        $whereArr = [];

        if(! empty($userName)) {
            $whereArr['lend.user_name'] = $userName;
        }

        if(! empty($userNickName)) {
            $whereArr['user_nickname'] = $userNickName;
        }

        if(! empty($bookCert)) {
            $whereArr['lend.book_cert'] = $bookCert;
        }

        if(! empty($bookName)) {
            $whereArr['book_name'] = $bookName;
        }

        if(! empty($lendStatus)) {
            $whereArr['lend_status'] = $lendStatus;
        }

        $lend = new \app\index\model\Lend();

        $lendList = $lend->field('lend.*, book_name,book_cate,book_public,book_place, user_nickname')->alias('lend')
            ->join('book_info book', 'lend.book_cert = book.book_cert')
            ->join('user_info user', 'user.user_name = lend.user_name')
            ->where($whereArr)
            ->order('lend_id', 'desc')
            ->paginate($limit);

        return [
            'code'  => 0,
            'count' => $lendList->total(),
            'data'  => $lendList->toArray()['data'],
            'msg'   => 'success'
        ];
    }

    public function lend_expired_table()
    {
        $limit = empty(intval(input('limit'))) ? 20 : intval(input('limit'));

        $lend = new \app\index\model\Lend();

        $lendList = $lend->field('lend.*, book_name,book_cate,book_public,book_place, user_nickname')->alias('lend')
            ->join('book_info book', 'lend.book_cert = book.book_cert')
            ->join('user_info user', 'user.user_name = lend.user_name')
            ->where('lend.expired_time', '<', date('Y-m-d H:i:s'))
            ->where('lend_status', 1)
            ->order('lend_id', 'desc')
            ->paginate($limit);

        return [
            'code'  => 0,
            'count' => $lendList->total(),
            'data'  => $lendList->toArray()['data'],
            'msg'   => 'success'
        ];
    }

    public function lend_status()
    {
        $lendId = input('lend_id');
        $lendStatus = input('lend_status');

        if(empty($lendId) || empty($lendStatus)) {
            return ['code' => 0, 'msg' => '参数有误，请刷新页面重试'];
        }

        $book = new \app\index\model\Book();
        $bookLend = new \app\index\model\Lend();
        $user = new \app\index\model\User();

        $lendRow = $bookLend->where('lend_id', $lendId)->find();

        if(empty($lendRow)) {
            return ['code' => 0, 'msg' => '未找到该图书借出记录'];
        }

        $bookCert = $lendRow['book_cert'];

        $bookRow = $book->where('book_cert', $bookCert)->find();

        if(empty($bookRow)) {
            return ['code' => 0, 'msg' => '该图书找不到'];
        }

        $bookRow = $bookRow->toArray();

        if($bookRow['book_status'] != 2) {
            return ['code' => 0, 'msg' => '该图书状态异常'];
        }

        if($lendStatus == 2) {
            $book->where('book_cert', $bookCert)->setInc('book_now_num');

            $bookLend->where('lend_id', $lendId)->update(['lend_status' => 2]);

            return ['code' => 1, 'msg' => '图书已归还'];
        }

        $userRow = $user->where(['user_name' => $lendRow['user_name']])->find();

        if(empty($userRow)) {
            return ['code' => 0, 'msg' => '用户信息异常'];
        }

        $userRow = $userRow->toArray();

        $userCateId = $userRow['user_cate'];

        if(empty($userCateId)) {
            return ['code' => 0, 'msg' => '用户身份异常'];
        }

        $userCate = new UserCate();

        $userCateRow = $userCate->where(['cate_id' => $userCateId])->find();

        if(empty($userCateRow)) {
            return ['code' => 0, 'msg' => '用户身份异常'];
        }

        $userCateRow = $userCateRow->toArray();

        $limitDay = empty($userCateRow['limit_day']) ? 0 : $userCateRow['limit_day'];

        if(empty($limitDay)) {
            return ['code' => 0, 'msg' => '用户身份数据异常'];
        }

        if($lendStatus == 3)
        {
            if(strtotime($lendRow['expired_time']) < time()) {
                return ['code' => 0, 'msg' => '图书借阅到期未归还，不可续借'];
            }

            $lendTime = date('Y-m-d H:i:s', strtotime($lendRow['expired_time']) + $limitDay * 24 * 60 * 60);
            $bookLend->where('lend_id', $lendId)->update(['expired_time' => $lendTime]);

            $book->where('book_cert', $bookCert)->setInc('book_total_out');

            return ['code' => 1, 'msg' => '图书续借成功'];
        }
    }

    public function lend_add()
    {
        return view('lend_add');
    }

    public function get_user_info()
    {
        $userName = input('user_name');

        if(empty(trim($userName))) {
            return ['code' => 0, 'msg' => '请输入用户编号'];
        }

        $user = new \app\index\model\User();

        $userRow = $user->where('user_name', $userName)->find();

        if(empty($userRow)) {
            return ['code' => 0, 'msg' => '获取用户失败'];
        }

        $userRow = $userRow->toArray();

        $userCateId = $userRow['user_cate'];

        if(empty($userCateId)) {
            return ['code' => 1, 'msg' => '获取用户成功', 'data' => $userRow];
        }

        $userCate = new UserCate();

        $userCateRow = $userCate->where('cate_id', $userCateId)->find();

        $userRow['user_cate'] = $userCateRow['cate_name'];
        $userRow['user_total'] = $userCateRow['limit_num'];

        return ['code' => 1, 'msg' => '获取用户成功', 'data' => $userRow];
    }

    public function get_book_info()
    {
        $bookCert = input('book_cert');

        if(empty(intval($bookCert))) {
            return ['code' => 0, 'msg' => '请输入图书编号'];
        }

        $book = new \app\index\model\Book();

        $bookRow = $book->field('book_cert,book_name,book_cate,book_public,book_place, book_now_num,place_name,cate_name,public_name')->alias('book')
            ->join('book_place_info place', 'book.book_place = place.place_id')
            ->join('book_cate_info cate', 'book.book_cate = cate.cate_id')
            ->join('public_info public', 'book.book_public = public.public_id')
            ->where(['book_cert' => $bookCert])->find();

        if(empty($bookRow)) {
            return ['code' => 0, 'msg' => '获取图书失败'];
        }

        return ['code' => 1, 'msg' => '获取图书成功', 'data' => $bookRow->toArray()];
    }

    public function lend_book()
    {
        $bookCert = input('book_cert');
        $userName = input('user_name');

        if(empty(intval($bookCert)) || empty(intval($userName))) {
            return ['code' => 0, 'msg' => '请输入图书编号或用户编号'];
        }

        $book = new \app\index\model\Book();
        $user = new \app\index\model\User();

        $bookRow = $book->where('book_cert', $bookCert)->find();
        $userRow = $user->where('user_name', $userName)->find();

        if(empty($bookRow) || empty($userRow)) {
            return ['code' => 0, 'msg' => '图书编号或用户编号输入错误'];
        }

        if($bookRow['book_now_num'] < 1) {
            return ['code' => 0, 'msg' => '该图书已被借完'];
        }

        $userCate = new UserCate();

        $userCateRow = $userCate->where('cate_id', $userRow['user_cate'])->find();

        $limitNum = $userCateRow['limit_num'];
        $limitDay = $userCateRow['limit_day'];

        $lend = new \app\index\model\Lend();

        $lendList = $lend->where('user_name', $userName)->where('lend_status', 1)->select();

        $lendNum = count($lendList);

        if($limitNum <= $lendNum) {
            return ['code' => 0, 'msg' => '该用户借书数量已达上限'];
        }

        $lendRow = [
            'book_cert'    => $bookCert,
            'user_name'    => $userName,
            'lend_status'  => 1,
            'expired_time' => date('Y-m-d H:i:s', time() + $limitDay * 24 * 60 * 60),
        ];

        $lend->create($lendRow);

        $book->where('book_cert', $bookCert)->setDec('book_now_num');
        $book->where('book_cert', $bookCert)->setInc('book_total_out');

        return ['code' => 1, 'msg' => '图书借出成功'];
    }

    public function lend_save()
    {
        $bookRow = input('');

        $book = new \app\index\model\Book();

        if(! empty($bookRow['book_id']))
        {
            $book->save($bookRow, ['book_id' => $bookRow['book_id']]);
        }else {
            $bookRow['book_now_num'] = $bookRow['book_num'];
            $book->create($bookRow);
        }

        return ['code' => 1, 'msg' => '操作成功'];
    }
}
