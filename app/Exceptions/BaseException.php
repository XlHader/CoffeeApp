<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class BaseException extends Exception
{
    public function __construct(?Exception $originalException = null, string $message, int $code)
    {
        parent::__construct($message, $code);

        if ($originalException) {
            $this->logException($originalException);
        }
    }

    public function render($request)
    {
        return response()->json([
            'message' => $this->getMessage(),
            'error' => true
        ], $this->getCode());
    }

    private function logException(Exception $exception): void
    {
        Log::error($exception->getMessage(), [
            'line' => $exception->getLine(),
            'file' => $exception->getFile()
        ]);
    }
}
