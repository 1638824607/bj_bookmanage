<?php
namespace app\index\controller;

class Place extends Base
{
    public function place_list()
    {
        return view('place_list');
    }

    public function place_table()
    {
        $limit = empty(intval(input('limit'))) ? 20 : intval(input('limit'));

        $place = new \app\index\model\Place();

        $placeList = $place->order('created_at', 'desc')->paginate($limit);

        return [
            'code'  => 0,
            'count' => $placeList->total(),
            'data'  => $placeList->toArray()['data'],
            'msg'   => 'success'
        ];
    }

    public function place_save()
    {
        $placeRow = input('');

        $place = new \app\index\model\Place();

        if(! empty($placeRow['place_id']))
        {
            $place->save($placeRow, ['place_id' => $placeRow['place_id']]);
        }else {
            $place->create($placeRow);
        }

        return ['code' => 1, 'msg' => '操作成功'];
    }
}
