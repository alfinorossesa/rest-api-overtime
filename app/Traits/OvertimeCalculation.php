<?php

namespace App\Traits;

use App\Models\Overtime;
use App\Models\Setting;

trait OvertimeCalculation
{
    public function overtimeDuration($time_ended, $time_started)
    {
        return round((strtotime($time_ended) - strtotime($time_started)) / (60*60), 2);
    }

    public function calculation($time_ended, $time_started)
    {
        if ($this->employee->reference->name == 'percobaan') {
            if (floor($this->overtimeDuration($time_ended, $time_started)) > 1) {
                
                return floor(floor($this->overtimeDuration($time_ended, $time_started)) - 1);

            } elseif (floor($this->overtimeDuration($time_ended, $time_started)) <= 1) {
                return null;
            }
        } else {
            return $this->overtimeDuration($time_ended, $time_started);
        }
    }

    public function overtimeTotal($id, $month)
    {
        $employee = Overtime::where('date', 'like', '%' . $month . '%' )->where('employee_id', $id)->get();
        
        $employee->map(function($overtime) {
            $overtime['overtime_duration'] = $this->calculation($overtime->time_ended, $overtime->time_started);
            
            return $overtime;
        });

        $overtimeTotal =  $employee->sum(function($overtime) {
            return $overtime->overtime_duration;
        });

        return $overtimeTotal;
    }

    public function amount($id, $month)
    {
        $setting = Setting::first();

        if ($setting->reference->name == 'salary / 173') {
            return round(($this->employee->salary / 173) * $this->overtimeTotal($id, $month));
        } elseif ($setting->reference->name == 'fixed') {
            return 10000 * $this->overtimeTotal($id, $month);
        }
    }
}