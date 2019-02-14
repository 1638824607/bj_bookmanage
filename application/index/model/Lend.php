<?php
namespace app\index\model;

use think\Model;

class Lend extends Model
{
    protected $resultSetType = 'collection';

    protected $insert = ['created_at', 'updated_at', 'created_day'];

    protected $update = ['updated_at'];

    protected $table  = 'book_lend_info';

    protected $type = [
        'lend_id'     =>  'integer',
        'book_cert'   =>  'integer',
        'user_name' =>  'integer',
        'lend_status'   =>  'integer',
        'expired_time'  =>  'string',
        'cretaed_day'  =>  'string',
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
    protected function setCreatedDayAttr()
    {
        return date('Y-m-d');
    }

    public function book()
    {
        return $this->hasOne('Book', 'book_cert')->field('book_cert,book_name');
    }
}