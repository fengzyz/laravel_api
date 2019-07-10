<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\Api\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\UserRequest;
use EasyWeChat\Factory;

class UserController extends Controller
{
    //返回用户列表
    public function index(){
        $users = User::paginate(3);
        return UserResource::collection($users);
    }
    //返回单一用户信息
    public function show(User $user){
        return $this->success(new UserResource($user));
    }
    //用户注册
    public function store(UserRequest $request){
        User::create($request->all());
        return $this->setStatusCode(201)->success('用户注册成功...');
    }


    //获取openid
    private function getSessionKey($code)
    {
        $config = config('wechat.mini_program.default');
        $app = Factory::miniProgram($config);
        return $app->auth->session($code);
    }
    //用户登录
    public function login(Request $request){
        $code = $request->code;
        // 获取openid
        if ($code) {
            $wx_info = $this->getSessionKey($code);
            if(isset($wx_info) && !empty($wx_info['errmsg'])){
                return $this->failed($wx_info['errmsg'], 406);
            }
            $openid = empty($wx_info['openid']) ? $request->openid : $wx_info['openid'];
            $userInfo = User::where('openid', $openid)->first();
        }else{
            return $this->failed('code没有获取到', 401);
        }
    }

    //用户退出
    public function logout(){
        Auth::guard('api')->logout();
        return $this->success('退出成功...');
    }
    //返回当前登录用户信息
    public function info(){
        $user = Auth::guard('api')->user();
        return $this->success(new UserResource($user));
    }

}
