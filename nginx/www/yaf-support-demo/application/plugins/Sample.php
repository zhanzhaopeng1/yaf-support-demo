<?php

use Yaf\Support\Http\Kernel;
use Yaf\Support\Log\ServiceProvider;
use Yaf\Application\Provider\RepositoryServiceProvider;
use Yaf\Application\Provider\ServicesProvider;
use Yaf\Support\Auth\AuthServiceProvider;

/**
 * @name SamplePlugin
 * @desc   Yaf定义了如下的6个Hook,插件之间的执行顺序是先进先Call
 * @see    http://www.php.net/manual/en/class.yaf-plugin-abstract.php
 * @author zhaopeng
 */
class SamplePlugin extends Yaf_Plugin_Abstract
{

    public function routerStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        // TODO 单独放到一个boot的方法中 并做可配置化
        (new ServiceProvider())->boot();
        (new AuthServiceProvider())->boot();
    }

    public function routerShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
        if (!empty($_GET)) {
            request()->setParams($_GET);
        }

        if (!empty($_POST)) {
            request()->setParams($_POST);
        }

        if (stripos($request->getServer('CONTENT_TYPE'), 'application/json') !== false
            && !empty(request()->getRawInput())) {
            request()->setParams(json_decode(request()->getRawInput(), true));
        }

        //核心逻辑
        app(Kernel::class)->handle($request);

        // TODO 注册provider 做可配置化
        app()->register(new ServicesProvider());
        app()->register(new RepositoryServiceProvider());
    }

    public function dispatchLoopStartup(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
    }

    public function preDispatch(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
    }

    public function postDispatch(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
    }

    public function dispatchLoopShutdown(Yaf_Request_Abstract $request, Yaf_Response_Abstract $response)
    {
    }
}
