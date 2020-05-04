<?php

use Yaf\Support\Foundation\Application;
use Yaf\Support\Http\Kernel;
use Yaf\Library\Response;

define('APPLICATION_PATH', dirname(__FILE__));

require __DIR__ . '/../vendor/autoload.php';

$app = new Application([], realpath(dirname(__FILE__)) . "/../");
Yaf_Registry::set('app', $app);

app()[Kernel::class] = function ($c) {
    return new Kernel($c);
};

app()['response'] = function ($c) {
    return new Response();
};

$application = new Yaf_Application(APPLICATION_PATH . "/../configs/application.ini");

$application->bootstrap()->run();
?>
