<?php

namespace Yaf\Application\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Yaf\Application\Repository\TestRepository;

class RepositoryServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple[TestRepository::class] = function () {
            return new TestRepository();
        };
    }
}