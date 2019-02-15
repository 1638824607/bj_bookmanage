<?php
namespace app\index\model;

use think\Model;

class Pay extends Model
{
    protected $resultSetType = 'collection';

    protected $insert = ['created_at', 'updated_at'];

    protected $update = ['updated_at'];

    protected $table  = 'book_pay_info';

    protected $type = [
        'pay_id'     =>  'integer',
        'book_cert'   =>  'string',
        'user_name'   =>  'string',
        'price'       =>  'string',
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
}