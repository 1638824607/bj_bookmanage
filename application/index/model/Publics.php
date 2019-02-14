<?php
namespace app\index\model;

use think\Model;

class Publics extends Model
{
    protected $resultSetType = 'collection';

    protected $insert = ['created_at', 'updated_at'];

    protected $update = ['updated_at'];

    protected $table  = 'public_info';

    protected $type = [
        'public_id'     =>  'integer',
        'public_name'   =>  'string',
        'public_status'   =>  'integer',
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