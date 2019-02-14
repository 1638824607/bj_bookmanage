<?php
namespace app\index\model;

use think\Model;

class User extends Model
{
    protected $resultSetType = 'collection';

    protected $insert = ['created_at', 'updated_at'];

    protected $update = ['updated_at'];

    protected $table  = 'user_info';

    protected $type = [
        'user_id'     =>  'integer',
        'user_name'   =>  'integer',
        'user_nickname' =>  'string',
        'user_pass'   =>  'string',
        'user_status'   =>  'integer',
        'user_email'   =>  'string',
        'user_type'   =>  'integer',
        'user_cate'   =>  'integer',
        'last_ip'   =>  'string',
        'last_time'   =>  'string',
        'created_at'  =>  'timestamp',
        'updated_at'  =>  'timestamp',
    ];

    protected function setCreatedAtAttr()
    {
        return date('Y-m-d H:i:s');
    }
    protected function setUpdatedAtAttr()
    {
        return date('Y-m-d H:i:s');
    }

    protected function setLastTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }
}