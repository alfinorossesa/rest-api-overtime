<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Reference;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function store($request)
    {
        if (!Reference::where('id', $request->status_id)->where('code', 'employee_status')->exists()) {
            return response()->json(['error' => 'status_id given not match'], 422);
        }
        
        return Employee::create($request->all());
    }

    public function all()
    {
        $employee = Employee::query();

        if (request()->has('per_page')) {
            $this->ifOrder($employee);
            $perPage = request('per_page');

            return $employee->paginate($perPage);
        } else {
            $this->ifOrder($employee); 
        }

        return $employee->paginate(10);
    }

    public function ifOrder($employee)
    {
        if (request()->has('order_type')) {
            if (request('order_type') == 'asc') {
                if (request()->has('order_by')) {
                    if (request('order_by') == 'name') {
                        $employee->orderBy('name', 'asc');
                    } elseif (request('order_by') == 'salary') {
                        $employee->orderBy('salary', 'asc');
                    }
                }
            } elseif (request('order_type') == 'desc') {
                if (request()->has('order_by')) {
                    if (request('order_by') == 'name') {
                        $employee->orderBy('name', 'desc');
                    } elseif (request('order_by') == 'salary') {
                        $employee->orderBy('salary', 'desc');
                    }
                }
            }
        }
    }
}