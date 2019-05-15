<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/5/15
 * Time: 10:48
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Anchor extends  Model
{
    //引用trait
    use SoftDeletes; // 软删除
    protected $dates = ['deleted_at'];
    protected $table = 'anchor_info'; //主播表

    protected $primaryKey = "anchor_id";

    protected $fillable = [
        'anchor_id','name','wechat','mobile_phone'
    ];
    protected $hidden = [
        'deleted_at','check_status'
    ];
}