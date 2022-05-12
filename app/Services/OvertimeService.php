<?php

namespace App\Services;

use App\Exceptions\OvertimeDateStartedMustBeFirst;
use App\Exceptions\OvertimeEmployeeNotFound;
use App\Exceptions\OvertimeMustHaveMonth;
use App\Models\Employee;
use App\Repositories\OvertimeRepositoryInterface;

class OvertimeService
{
    protected $overtime;
    public function __construct(OvertimeRepositoryInterface $overtime)
    {
        $this->overtime = $overtime;
    }

    public function overtimeStore($request)
    {
        if (!Employee::where('id', $request->employee_id)->first()) {
            throw new OvertimeEmployeeNotFound();
        }

        $overtime = $this->overtime->store($request);

        return $overtime;
    }

    public function getOvertime()
    {
        $overtimes = $this->overtime->getAll();
        
        if (request()->has('date_started')) {
            if (request()->has('date_ended')) {
                if (request('date_started') <= request('date_ended')) {
                    $overtime = $overtimes->whereBetween('date', [request('date_started'), request('date_ended')])->get();
                    return $overtime;
                } else {
                    throw new OvertimeDateStartedMustBeFirst();
                }
            }
        }

        return $overtimes->get();
    }

    public function overtimeCalculate()
    {
        if (request()->has('month')) {
            $overtimes = $this->overtime->calculate();
            return $overtimes;
        }

        throw new OvertimeMustHaveMonth();
    }
}