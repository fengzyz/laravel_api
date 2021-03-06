<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $table = 'users';
    const CREATED_AT = 'createtime';
    const UPDATED_AT = 'updatetime';
    public $timestamps = true;
    protected $dateFormat = 'U';

    //去掉我创建的数据表没有的字段
    protected $fillable = [
        'username', 'password'
    ];

    //去掉我创建的数据表没有的字段
    protected $hidden = [
        'password'
    ];
    //将密码进行加密
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
