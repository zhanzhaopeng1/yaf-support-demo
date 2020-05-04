<?php

use Yaf\Library\Response;

if (!function_exists('response')) {

    /**
     * @return Response
     */
    function response()
    {
        if (app('response')) {
            return app('response');
        }

        app()['response'] = function () {
            return new Response();
        };

        return app('response');
    }
}