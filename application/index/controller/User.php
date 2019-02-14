<?php
namespace app\index\controller;

use app\index\model\UserCate;

class User extends Base
{
    public function user_cate_list()
    {
        return view('user_cate_list');
    }

    public function user_cate_table()
    {
        $limit = empty(intval(input('limit'))) ? 20 : intval(input('limit'));

        $userCate = new UserCate();

        $userCateList = $userCate->order('cate_id', 'desc')->paginate($limit);

        return [
            'code'  => 0,
            'count' => $userCateList->total(),
            'data'  => $userCateList->toArray()['data'],
            'msg'   => 'success'
        ];
    }

    public function user_cate_save()
    {
        $userCateRow = input('');

        $userCate = new UserCate();

        if(! empty($userCateRow['cate_id']))
        {
            $userCate->save($userCateRow, ['cate_id' => $userCateRow['cate_id']]);
        }else {
            $userCate->create($userCateRow);
        }

        return ['code' => 1, 'msg' => '操作成功'];
    }

    public function user_list()
    {
        $userCate = new UserCate();
        $userCateList = $userCate->select();

        if(!empty($userCateList)) {
            $userCateList = array_column($userCateList->toArray(),null,'cate_id');
        }

        return view('user_list', [
            'userCateList' => $userCateList
        ]);
    }

    public function user_table()
    {
        $limit = empty(intval(input('limit'))) ? 20 : intval(input('limit'));

        $userName     = empty(trim(input('user_name'))) ? '' : trim(input('user_name'));
        $userNickName = empty(trim(input('user_nickname'))) ? '' : trim(input('user_nickname'));

        $whereArr = [
            'user_type' => 1
        ];

        if(! empty($userName)) {
            $whereArr['user_name'] = $userName;
        }

        if(! empty($userNickName)) {
            $whereArr['user_nickname'] = $userNickName;
        }

        $user = new \app\index\model\User();

        $userList = $user->where($whereArr)->order('user_id', 'desc')->paginate($limit);

        return [
            'code'  => 0,
            'count' => $userList->total(),
            'data'  => $userList->toArray()['data'],
            'msg'   => 'success'
        ];
    }

    public function user_save()
    {
        $userRow = input('');

        $user = new \app\index\model\User();

        $userExist = $user->whereOr('user_name', $userRow['user_name'])->whereOr('user_nickname', $userRow['user_nickname'])->find();

        if(! empty($userRow['user_id']))
        {
            if($userExist && $userRow['user_id'] != $userExist['user_id']) {
                return ['code' => 0, 'msg' => '编号已存在'];
            }

            $user->save($userRow, ['user_id' => $userRow['user_id']]);
        }else
        {
            if($userExist) {
                return ['code' => 0, 'msg' => '编号已存在'];
            }

            $userRow['last_time'] = date('Y-m-d', time());
            $userRow['user_pass'] = md5(123456);
            $userRow['user_type'] = 1;
            $user->create($userRow);
        }

        return ['code' => 1, 'msg' => '操作成功'];
    }


    public function admin_list()
    {
        return view('admin_list');
    }

    public function admin_table()
    {
        $limit = empty(intval(input('limit'))) ? 20 : intval(input('limit'));

        $user = new \app\index\model\User();

        $userList = $user->where('user_type', 2)->order('user_id', 'desc')->paginate($limit);

        return [
            'code'  => 0,
            'count' => $userList->total(),
            'data'  => $userList->toArray()['data'],
            'msg'   => 'success'
        ];
    }

    public function admin_save()
    {
        $userRow = input('');

        $user = new \app\index\model\User();

        $userExist = $user->where('user_name', $userRow['user_name'])->find();

        if(! empty($userRow['user_id']))
        {
            if($userExist && $userRow['user_id'] != $userExist['user_id']) {
                return ['code' => 0, 'msg' => '编号已存在'];
            }

            $user->save($userRow, ['user_id' => $userRow['user_id']]);
        }else
        {
            if($userExist)
            {
                return ['code' => 0, 'msg' => '编号已存在'];
            }

            $userRow['last_time'] = date('Y-m-d', time());
            $userRow['user_pass'] = md5(123456);
            $userRow['user_type'] = 2;
            $user->create($userRow);
        }

        return ['code' => 1, 'msg' => '操作成功'];
    }
}
