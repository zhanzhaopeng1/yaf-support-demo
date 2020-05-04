<?php

namespace Yaf\Application\Repository;

class TestRepository
{
    public function test($age, $name)
    {
        return [
            'userId' => Auth()->id(),
            'age'    => $age,
            'name'   => Auth()->user()->username
        ];
    }
}