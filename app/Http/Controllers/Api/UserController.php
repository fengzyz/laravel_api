<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\Api\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\UserRequest;

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
    //用户登录
    public function login(Request $request){
        //获取当前守护的名称
        $present_guard =Auth::getDefaultDriver();
        $token = Auth::claims(['guard'=>$present_guard])->attempt(['name' => $request->name, 'password' => $request->password]);
        if ($token) {
            //如果登陆，先检查原先是否有存token，有的话先失效，然后再存入最新的token
            $user = Auth::user();
            if ($user->last_token) {
                try{
                    Auth::setToken($user->last_token)->invalidate();
                }catch (TokenExpiredException $e){
                    //因为让一个过期的token再失效，会抛出异常，所以我们捕捉异常，不需要做任何处理
                }
            }
            $user->last_token = $token;
            $user->save();
            return $this->setStatusCode(201)->success(['token' => 'bearer ' . $token]);
        }
        return $this->failed('账号或密码错误', 400);
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
