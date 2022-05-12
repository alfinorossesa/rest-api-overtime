<?php

namespace App\Http\Controllers;

use App\Exceptions\EmployeeStatusNotMatch;
use App\Http\Requests\EmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    private $employee;

    public function __construct(EmployeeService $employee)
    {
        $this->employee = $employee;
    }

    public function store(EmployeeRequest $request)
    {
        try {
            return $this->employee->employeeStore($request);
        } catch (EmployeeStatusNotMatch $exception) {
            throw $exception->validationException();
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(['error' => 'you get error'], 500);
        } 
    }

    public function index()
    {
        return $this->employee->getEmployee();
    }

}
