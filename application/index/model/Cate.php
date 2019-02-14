<?php
namespace app\index\model;

use think\Model;

class Cate extends Model
{
    protected $resultSetType = 'collection';

    protected $insert = ['created_at', 'updated_at'];

    protected $update = ['updated_at'];

    protected $table  = 'book_cate_info';

    protected $type = [
        'cate_id'     =>  'integer',
        'cate_name'   =>  'string',
        'cate_status'   =>  'integer',
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