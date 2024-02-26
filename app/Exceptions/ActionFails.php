<?php

namespace App\Exceptions;

use PHPUnit\Util\Xml\Exception;

class ActionFails extends Exception
{
    protected $message;

    public function __construct($message = 'Resource not found')
    {
        parent::__construct($message);
        $this->message = $message;
    }

    public function render($request): \Illuminate\Http\JsonResponse
    {
        return response()->json(['error' => $this->message], 404);
    }


}
