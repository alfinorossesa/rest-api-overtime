<?php

namespace App\Repositories;

use App\Exceptions\OvertimeDateStartedMustBeFirst;
use App\Exceptions\OvertimeEmployeeNotFound;
use App\Exceptions\OvertimeMustHaveMonth;
use App\Models\Employee;
use App\Models\Overtime;

class OvertimeRepository implements OvertimeRepositoryInterface
{
    public function store($request)
    {
        if (!Employee::where('id', $request->employee_id)->first()) {
            throw new OvertimeEmployeeNotFound;
        }

        return Overtime::create($request->all());
    }

    public function get()
    {
        $overtimes = Overtime::query();

        if (request()->has('date_started')) {
            if (request()->has('date_ended')) {
                if (request('date_started') <= request('date_ended')) {
                    $overtime = $overtimes->whereBetween('date', [request('date_started'), request('date_ended')])->get();
                    return $overtime;
                } else {
                    throw new OvertimeDateStartedMustBeFirst;
                }
            }
        }

        return $overtimes->get();
    }

    public function calculate()
    {
        if (request()->has('month')) {
            $overtimes = Overtime::where('date', 'like', '%'. request('month') .'%')->get();
            return $overtimes;
        }

        throw new OvertimeMustHaveMonth;
    }
}