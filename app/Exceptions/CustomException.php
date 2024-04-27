<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception{

    protected $message;

    public function __construct($message = 'error', $codeHTTP = 500)
    {
        parent::__construct($message);
        $this->message = $message;
        $this->code = $codeHTTP;
    }

    public function render($request): \Illuminate\Http\JsonResponse
    {
        return response()->json(['error' => $this->message], $this->code );
    }

}
