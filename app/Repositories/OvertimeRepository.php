<?php

namespace App\Repositories;

use App\Http\Resources\OvertimePay;
use App\Models\Employee;
use App\Models\Overtime;

class OvertimeRepository implements OvertimeRepositoryInterface
{
    public function store($request)
    {
        if (!Employee::where('id', $request->employee_id)->first()) {
            return response()->json(['error' => 'employee not found'], 404);
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
                    return response()->json(['error' => 'date started must be first'], 422);
                }
            }
        }

        return $overtimes->get();
    }

    public function calculate()
    {
        if (request()->has('month')) {
            $overtimes = Overtime::where('date', 'like', '%'. request('month') .'%')->get();
            return OvertimePay::collection($overtimes);
        }

        return response()->json(['error' => 'please select month'], 200);
    }
}