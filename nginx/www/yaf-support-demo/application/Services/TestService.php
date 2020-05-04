<?php

namespace Yaf\Application\Services;

use Yaf\Application\Repository\TestRepository;

class TestService
{
    /**
     * @var TestRepository
     */
    protected $repository;

    public function __construct(TestRepository $testRepository)
    {
        $this->repository = $testRepository;
    }

    public function test($age, $name)
    {
        return $this->repository->test($age, $name);
    }
}