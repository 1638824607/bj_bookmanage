<?php
namespace app\index\model;

use think\Model;

class Site extends Model
{
    protected $resultSetType = 'collection';

    protected $insert = ['created_at', 'updated_at'];

    protected $update = ['updated_at'];

    protected $table  = 'site_info';

    protected $type = [
        'site_id'     =>  'integer',
        'site_name'   =>  'string',
        'site_time' =>  'string',
        'site_user'   =>  'string',
        'site_tel'   =>  'string',
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