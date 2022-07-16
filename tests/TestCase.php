<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * 建立假物件取代原來的物件
     *
     * @param string $class
     * @return \Mockery\MockInterface|\Mockery\LegacyMockInterface
     */
    protected function initMock($class)
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);
        return $mock;
    }
}
