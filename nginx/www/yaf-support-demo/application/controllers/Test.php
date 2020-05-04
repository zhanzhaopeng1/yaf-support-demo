<?php

use Yaf\Application\Services\TestService;

/**
 * @name IndexController
 * @author zhaopeng
 * @desc   默认控制器
 * @see    http://www.php.net/manual/en/class.yaf-controller-abstract.php
 */
class TestController extends BaseController
{
    /**
     * @var TestService
     */
    protected $service;

    /**
     * @throws ReflectionException
     */
    public function init()
    {
        parent::init();

        $this->service = $this->app->build(TestService::class);
    }

    /**
     * @param string $name
     * @throws \Yaf\Support\Validation\ValidationException
     */
    public function testAction($name = "Stranger")
    {
        // 校验器
        validator()->validate([
            'age'  => 'required|int|between:1,100',
            'name' => 'required|string'
        ]);

        // 获取参数
        $age  = request()->getParam('age');
        $name = request()->getParam('name', 'test');

        // 返回结果
        response()->jsonReturn($this->service->test($age, $name));
    }

    /**
     * @throws \Yaf\Support\Validation\ValidationException
     */
    public function test1Action()
    {

    }
}
