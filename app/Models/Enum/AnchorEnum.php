<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/5/15
 * Time: 13:48
 */

namespace App\Models\Enum;


class AnchorEnum
{
    const MALE = 2 ;    //男
    const FEMALE = 1;   //女

    public function getSexName($sex){
        switch ($sex){
            case self::MALE:
                return '男';
            case  self::FEMALE:
                return '女';
            default:
                return '女';
        }
    }
}