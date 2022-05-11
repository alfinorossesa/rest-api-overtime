<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class SettingKeyNotMatch extends Exception
{
    public function validationException()
    {
        return ValidationException::withMessages([
            'key' => 'key must overtime_method'
        ]);
    }
}
