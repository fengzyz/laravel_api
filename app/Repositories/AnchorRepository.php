<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/5/15
 * Time: 11:01
 */

namespace App\Repositories;
use App\Models\Anchor;

class AnchorRepository extends BaseRepository
{
    /**
     * 定义数据模型
     */
    const MODEL = Anchor::class;

    protected $searchKey = [
        'keywords',
    ];

    public function serialization(array $attributes){
        $anchor = self::MODEL;
        $anchor = new $anchor();
        return $anchor;
    }

    /**
     * @param $where 查询参数 array
     * @return mixed
     */
    public function queryListByWhere($where){
        $where = array_filter($where);
        //对参数进行过滤
        $query = $this->query();
        $keywords = isset($where['keywords']) ? $where['keywords'] : '';
        $pageSize = isset($where['pageSize']) ? $where['pageSize'] : 20;
        unset($where['pageSize']);
        unset($where['keywords']);
        foreach ($where as $key => $value) {
            if(in_array($key,$this->searchKey)){
                $query->where($key, $value);
            }
        }
        if(!empty($keywords)){
            $query->where(function ($query) use ($keywords) {
                $query->where('name', 'like', "%{$keywords}%")->orWhere('mobile_phone', 'like', "%{$keywords}%");
            });
        }
        $query->where('check_status',2);
        $query->orderBy('created_at','desc');
        $res = $query->paginate($pageSize);

        return $res;
    }
}