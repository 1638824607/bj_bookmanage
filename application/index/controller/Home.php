<?php
namespace app\index\controller;


use app\index\model\Site;

class Home extends Base
{
    public function site_info()
    {
        $site = new Site();

        $siteRow = $site->find();

        return view('site_info', [
            'siteRow' => $siteRow
        ]);
    }
}
