<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class EmployeeStatusNotMatch extends Exception
{
    public function validationException()
    {
        return ValidationException::withMessages([
            'status_id' => 'status_id given is not match'
        ]);
    }
}
