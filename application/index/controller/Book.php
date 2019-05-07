<?php
namespace app\index\controller;

class Book extends Base
{
    public function book_list()
    {
        $cate = new \app\index\model\Cate();
        $public = new \app\index\model\Publics();
        $place = new \app\index\model\Place();

        $cateList = $cate->where('cate_status', 2)->column('*');

        $publicList = $public->where('public_status', 2)->column('*');
        $placeList = $place->where('place_status', 2)->column('*');

        return view('book_list', [
            'cateList' => $cateList,
            'publicList' => $publicList,
            'placeList' => $placeList
        ]);
    }

    public function book_user_list()
    {
        $cate = new \app\index\model\Cate();
        $public = new \app\index\model\Publics();
        $place = new \app\index\model\Place();
        $lend = new \app\index\model\Lend();

        $cateList = $cate->where('cate_status', 2)->column('*');

        $publicList = $public->where('public_status', 2)->column('*');
        $placeList = $place->where('place_status', 2)->column('*');

        $lendList = $lend->where('user_name', session('user_info')['user_name'])->where('lend_status', 1)->column('book_cert');

        return view('book_user_list', [
            'cateList'   => $cateList,
            'publicList' => $publicList,
            'placeList'  => $placeList,
            'lendList'   => $lendList,
        ]);
    }

    public function book_table()
    {
        $limit = empty(intval(input('limit'))) ? 20 : intval(input('limit'));

        $bookCert = empty(intval(input('book_cert'))) ? 0 : intval(input('book_cert'));
        $bookName = empty(trim(input('book_name'))) ? '' : trim(input('book_name'));
        $bookCate = empty(intval(input('book_cate'))) ? 0 : intval(input('book_cate'));

        $whereArr = [];

        if(! empty($bookCert)) {
            $whereArr['book_cert'] = $bookCert;
        }

        if(! empty($bookName)) {
            $whereArr['book_name'] = ['like', "%{$bookName}%"];
        }

        if(! empty($bookCate)) {
            $whereArr['book_cate'] = $bookCate;
        }

        $book = new \app\index\model\Book();

        $bookList = $book->where($whereArr)->order('book_id', 'desc')->paginate($limit);

        return [
            'code'  => 0,
            'count' => $bookList->total(),
            'data'  => $bookList->toArray()['data'],
            'msg'   => 'success'
        ];
    }

    public function book_save()
    {
        $bookRow = input('post.');

        $bookCert = intval($bookRow['book_cert']);
        $bookName = trim($bookRow['book_name']);

        if(empty($bookCert) || empty($bookName)) {
            return ['code' => 0, 'msg' => '信息不完整'];
        }

        $book = new \app\index\model\Book();

        $bookInfo = $book->whereOr('book_cert', $bookCert)->whereOr('book_name', $bookName)->find();

        if(! empty($bookRow['book_id']))
        {

            if(! empty($bookInfo) && $bookInfo['book_id'] != $bookRow['book_id']) {
                return ['code' => 0, 'msg' => '该图书编号或名称已存在'];
            }

            $bookDbRow = $book->where('book_id', $bookRow['book_id'])->find();

            if($bookDbRow['book_num'] > $bookRow['book_num'])
            {
                if($bookDbRow['book_now_num'] < ($bookDbRow['book_num'] - $bookRow['book_num'])) {
                    return ['code' => 0, 'msg' => '图书当前库存数不得小于0'];
                }

                $bookRow['book_now_num'] = $bookDbRow['book_now_num'] - ($bookDbRow['book_num'] - $bookRow['book_num']);
            }elseif($bookDbRow['book_num'] < $bookRow['book_num']) {
                $bookRow['book_now_num'] = $bookDbRow['book_now_num'] + ($bookRow['book_num'] - $bookDbRow['book_num']);
            }

            $book->save($bookRow, ['book_id' => $bookRow['book_id']]);

        }else
        {
            $bookRow['book_now_num'] = $bookRow['book_num'];

            if(! empty($bookInfo)) {
                return ['code' => 0, 'msg' => '该图书编号或名称已存在'];
            }

            $book->create($bookRow);
        }

        return ['code' => 1, 'msg' => '操作成功'];
    }
}
