<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/5/15
 * Time: 11:24
 */

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Services\AnchorService;

class AnchorController extends Controller
{

    protected $anchorService;
    public function __construct()
    {
        $this->anchorService = new AnchorService();
    }
    //获取列表
    public function list(Request $request){
        return $this->anchorService->queryList($request->toArray());
    }
}