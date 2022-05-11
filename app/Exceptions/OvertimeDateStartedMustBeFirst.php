<?php

namespace App\Exceptions;

use Exception;

class OvertimeDateStartedMustBeFirst extends Exception
{
    public function render()
    {
        return ['error' => 'date started must be first'];
    }
}
