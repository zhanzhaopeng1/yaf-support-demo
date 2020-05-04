<?php

namespace Yaf\Application\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Yaf\Application\Services\TestService;

class ServicesProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple[TestService::class] = TestService::class;
    }
}