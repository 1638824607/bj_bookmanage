<?php
namespace app\index\controller;

class Publics extends Base
{
    public function public_list()
    {
        return view('public_list');
    }

    public function public_table()
    {
        $limit = empty(intval(input('limit'))) ? 20 : intval(input('limit'));

        $publics = new \app\index\model\Publics();

        $publicList = $publics->order('created_at', 'desc')->paginate($limit);

        return [
            'code'  => 0,
            'count' => $publicList->total(),
            'data'  => $publicList->toArray()['data'],
            'msg'   => 'success'
        ];
    }

    public function public_save()
    {
        $publicRow = input('post.');

        $publics = new \app\index\model\Publics();

        if(! empty($publicRow['public_id']))
        {
            $publics->save($publicRow, ['public_id' => $publicRow['public_id']]);
        }else {
            $publics->create($publicRow);
        }

        return ['code' => 1, 'msg' => '操作成功'];
    }
}
