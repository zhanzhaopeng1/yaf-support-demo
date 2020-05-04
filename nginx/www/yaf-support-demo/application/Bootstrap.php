<?php

use Yaf\Support\Http\Request;

/**
 * @name Bootstrap
 * @author zhaopeng
 * @desc   所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see    http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf_Bootstrap_Abstract
{

    public function _initConfig()
    {
        //把配置保存起来
        $arrConfig = Yaf_Application::app()->getConfig();
        Yaf_Registry::set('config', $arrConfig);
        // 不用视图模式
        Yaf_Dispatcher::getInstance()->autoRender(false);
    }

    public function _initPlugin(Yaf_Dispatcher $dispatcher)
    {
        //注册一个插件
        $objSamplePlugin = new SamplePlugin();
        $dispatcher->registerPlugin($objSamplePlugin);
    }

    /**
     * @param Yaf_Dispatcher $dispatcher
     * @throws Yaf_Exception_TypeError
     */
    public function _initRoute(Yaf_Dispatcher $dispatcher)
    {
        //在这里注册自己的路由协议,默认使用简单路由,可以将路由抽离出去，eg:api/test/test or m/test/test 分别找不同的路由文件
        $urlMap = [
            'test/test'  => ['controller' => 'Test', 'action' => 'test', 'sign' => 'md5', 'method' => 'get', 'middleware' => 'auth'],
            'test/test1' => ['controller' => 'Test', 'action' => 'test1', 'sign' => 'md5', 'method' => 'get', 'middleware' => ''],
            'test/test2' => ['controller' => 'Test', 'action' => 'test2', 'sign' => 'md5', 'method' => 'post', 'middleware' => ''],
        ];

        $uri  = trim($dispatcher->getInstance()->getRequest()->getRequestUri(), '/');
        $item = $urlMap[$uri];
        $dispatcher->getRouter()->addRoute($uri, new Yaf_Route_Rewrite($uri, $item));

        // 重新设置request
        $yafRequest      = $dispatcher->getInstance()->getRequest();
        $request         = new Request($yafRequest->getRequestUri(), $yafRequest->getBaseUri());
        $request->method = $yafRequest->method;
        $request->setSign($item['sign']);
        $request->setShouldMethod($item['method']);
        $request->setMiddleware(explode(',', $item['middleware']));
        //全局注册request
        app()['request'] = function ($c) use ($request) {
            return $request;
        };

        $dispatcher->getInstance()->setRequest($request);
    }

    public function _initView(Yaf_Dispatcher $dispatcher)
    {
        //在这里注册自己的view控制器，例如smarty,firekylin
    }
}
