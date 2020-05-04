<?php

namespace Yaf\Library;

use Yaf\Support\Log\Log;
use Yaf\Support\Response\Response as BaseResponse;

class Response extends BaseResponse
{
    public function jsonReturn(array $data, string $message = 'success', int $code = 0, int $httpCode = 200)
    {
        parent::jsonReturn($data, $message, $code, $httpCode);

        Log::info($this->getBody());
    }
}