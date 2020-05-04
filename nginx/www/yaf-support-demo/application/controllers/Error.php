<?php

use Yaf\Support\Response\Response;
use Yaf\Support\Log\Log;

/**
 * @name ErrorController
 * @desc   错误控制器, 在发生未捕获的异常时刻被调用
 * @see    http://www.php.net/manual/en/yaf-dispatcher.catchexception.php
 * @author zhaopeng
 */
class ErrorController extends Yaf_Controller_Abstract
{

    /**
     * @param Exception $exception
     */
    public function errorAction($exception)
    {
        response()->jsonReturn(['error' => $exception->getMessage()], $exception->getMessage(), $exception->getCode());

        // 判断code 不在集合中 则打印错误日志
        Log::error(response()->getBody());
    }
}
