<?php

class BaseController extends Yaf_Controller_Abstract
{
    /**
     * @var \Yaf\Support\Foundation\Application
     */
    protected $app;

    public function init()
    {
        $this->app = app();
    }
}