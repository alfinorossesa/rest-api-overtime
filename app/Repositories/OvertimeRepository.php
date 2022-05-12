<?php

namespace App\Repositories;

use App\Models\Overtime;

class OvertimeRepository implements OvertimeRepositoryInterface
{
    public function store($request)
    {
        $overtime = Overtime::create($request->all());

        return $overtime;
    }

    public function getAll()
    {
        $overtimes = Overtime::query();

        return $overtimes;
    }

    public function calculate()
    {
        $overtimes = Overtime::where('date', 'like', '%'. request('month') .'%')->get();
        return $overtimes;
    }
}