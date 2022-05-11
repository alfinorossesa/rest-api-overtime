<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class SettingValueNotMatch extends Exception
{
    public function validationException()
    {
        return ValidationException::withMessages([
            'value' => 'value given not match'
        ]);
    }
}
