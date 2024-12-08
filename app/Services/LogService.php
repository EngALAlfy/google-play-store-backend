<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class LogService
{
    /**
     * @param Throwable $exception
     * @param null $message
     * @param string|null $functionName
     * @param string|null $className
     * @return string
     */
    public static function error(Throwable $exception, $message = null, ?string $functionName = __FUNCTION__, ?string $className = __CLASS__): string
    {
        $code = Str::random(10);
        $logMessage = <<<LOG
            Developer Code       : $code
            Function Name        : $functionName
            Class Name           : $className
            Developer Message    : $message
            Exception Message    : {$exception->getMessage()}
            Exception Code       : {$exception->getCode()}
            Exception Line       : {$exception->getLine()}
            Exception File       : {$exception->getFile()}
            Exception Trace      : {$exception->getTraceAsString()}
            LOG;

        Log::error($logMessage);
        return $code;

    }
}
