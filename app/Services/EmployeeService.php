<?php

namespace App\Services;

use App\Exceptions\EmployeeStatusNotMatch;
use App\Models\Reference;
use App\Repositories\EmployeeRepositoryInterface;

class EmployeeService
{
    protected $employee;
    public function __construct(EmployeeRepositoryInterface $employee)
    {
        $this->employee = $employee;
    }

    public function employeeStore($request)
    {
        if (!Reference::where('id', $request->status_id)->where('code', 'employee_status')->exists()) {
            throw new EmployeeStatusNotMatch();
        }

        $employee = $this->employee->store($request);

        return $employee;
    }

    public function getEmployee()
    {
        
        $employee = $this->employee->all();

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