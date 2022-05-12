<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function store($request)
    {
        $employee = Employee::create($request->all());
        
        return $employee;
    }

    public function all()
    {
        $employee = Employee::query();

        return $employee;
    }

    
}