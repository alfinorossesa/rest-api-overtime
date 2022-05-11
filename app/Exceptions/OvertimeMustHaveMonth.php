<?php

namespace App\Exceptions;

use Exception;

class OvertimeMustHaveMonth extends Exception
{
    public function render()
    {
        return ['error' => 'please select month'];
    }
}
