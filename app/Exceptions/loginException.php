<?php

namespace App\Exceptions;

use Exception;

class loginException extends Exception
{
    public $message;
    public $code;
    public function __construct($message,$code)
    {
        parent::__construct($message,$code);
    }
}
