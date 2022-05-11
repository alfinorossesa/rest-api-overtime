<?php

namespace App\Http\Controllers;

use App\Exceptions\OvertimeEmployeeNotFound;
use App\Exceptions\OvertimeException;
use App\Http\Requests\OvertimeRequest;
use App\Http\Resources\OvertimePay;
use App\Repositories\OvertimeRepositoryInterface;
use Illuminate\Support\Facades\Log;

class OvertimeController extends Controller
{
    private $overtime;

    public function __construct(OvertimeRepositoryInterface $overtime)
    {
        $this->overtime = $overtime;
    }

    public function store(OvertimeRequest $request)
    { 
        try {
            return $this->overtime->store($request);
        } catch(OvertimeEmployeeNotFound $exception) {
            throw $exception->validationException();
        } catch (\Throwable $th) {
            Log::info($th);
            return response()->json(['error' => 'you get error'], 500);
        }
    }

    public function index()
    {
        return $this->overtime->get();
    }

    public function calculate()
    {
        return OvertimePay::collection($this->overtime->calculate());
    }
}
