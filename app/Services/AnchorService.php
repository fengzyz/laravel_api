<?php
/**
 * Created by PhpStorm.
 * User: shuyu
 * Date: 2019/5/15
 * Time: 10:57
 */

namespace App\Services;
use App\Exceptions\ExceptionResult;
use App\Repositories\AnchorRepository;


class AnchorService
{

    /**
     * @var AnchorRepository
     */
    private $anchorRepository;

    public function __construct()
    {
        $this->anchorRepository = new AnchorRepository();
    }
    /**
     * @param $request
     * @return mixed
     */
    public function queryList($params = [])
    {

        try {
            $anchor = $this->anchorRepository->queryListByWhere($params);
            return $anchor;
        } catch (\Exception $e) {
            ExceptionResult::throwException($e);
        }
    }
}