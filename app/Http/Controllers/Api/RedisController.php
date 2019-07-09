<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function test(Request $request){

        Redis::set('name', 'guwenjie');
        $name = Redis::get("name");
        print_r($name);
    }
}
