<?php
namespace app\index\model;

use think\Model;

class Place extends Model
{
    protected $resultSetType = 'collection';

    protected $insert = ['created_at', 'updated_at'];

    protected $update = ['updated_at'];

    protected $table  = 'book_place_info';

    protected $type = [
        'place_id'     =>  'integer',
        'place_name'   =>  'string',
        'place_status'   =>  'integer',
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