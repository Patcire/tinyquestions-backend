<?php

namespace App\Exceptions;

use PHPUnit\Util\Xml\Exception;

class AlreadyExist extends Exception
{

    protected $message;

    public function __construct($message = 'Infraction on sql values')
    {
        parent::__construct($message);
        $this->message = $message;
    }

    public function render($request): \Illuminate\Http\JsonResponse
    {
        return response()->json(['error' => $this->message], 409);
    }
}
