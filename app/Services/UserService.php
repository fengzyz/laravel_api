<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/7/8
 * Time: 9:25
 */

namespace App\Services;


class UserService
{
    protected $app_id;
    protected $app_secret;
    protected $wx_login_url;

    public $code;              //code码
    protected $nickname;      //昵称

    public function __construct($code)
    {
        $this->code = $code;
        $this->app_id = config('wx.app_id');
        $this->app_secret = config('wx.app_secret');
        $this->wx_login_url = sprintf(config('wx.login_url'),$this->app_id,$this->app_secret,$code);
    }
}