<?php
namespace app\index\controller;

class Cate extends Base
{
    public function cate_list()
    {
        return view('cate_list');
    }

    public function cate_table()
    {
        $limit = empty(intval(input('limit'))) ? 20 : intval(input('limit'));

        $cate = new \app\index\model\Cate();

        $cateList = $cate->order('created_at', 'desc')->paginate($limit);

        return [
            'code'  => 0,
            'count' => $cateList->total(),
            'data'  => $cateList->toArray()['data'],
            'msg'   => 'success'
        ];
    }

    public function cate_save()
    {
        $cateRow = input('post.');

        $cate = new \app\index\model\Cate();

        if(! empty($cateRow['cate_id']))
        {
            $cate->save($cateRow, ['cate_id' => $cateRow['cate_id']]);
        }else {
            $cate->create($cateRow);
        }

        return ['code' => 1, 'msg' => '操作成功'];
    }
}
