<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Repositories\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    private $employee;

    public function __construct(EmployeeRepositoryInterface $employee)
    {
        $this->employee = $employee;
    }

    public function store(EmployeeRequest $request)
    {
        try {
            return $this->employee->store($request);
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(['error' => 'error'], 500);
        } 
    }

    public function index()
    {
        return $this->employee->all();
    }

}
