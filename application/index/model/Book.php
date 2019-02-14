<?php
namespace app\index\model;

use think\Model;

class Book extends Model
{
    protected $resultSetType = 'collection';

    protected $insert = ['created_at', 'updated_at'];

    protected $update = ['updated_at'];

    protected $table  = 'book_info';

    protected $type = [
        'book_id'     =>  'integer',
        'book_cert'   =>  'integer',
        'book_name' =>  'string',
        'book_place'   =>  'integer',
        'book_cate'   =>  'integer',
        'book_public'   =>  'integer',
        'book_num'   =>  'integer',
        'book_now_num'   =>  'integer',
        'book_total_out'   =>  'integer',
        'book_status'   =>  'integer',
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