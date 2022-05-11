<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class OvertimeEmployeeNotFound extends Exception
{
    public function validationException()
    {
        return ValidationException::withMessages([
            'employee_id' => 'employee not found'
        ]);
    }
}
