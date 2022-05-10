<?php

namespace App\Models;

use App\Traits\OvertimeCalculation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory, OvertimeCalculation;
    protected $fillable = ['employee_id', 'date', 'time_started', 'time_ended'];
    public $timestamps = false;

    public function setTimeStartedAttribute($value) {
        $this->attributes['time_started'] = (new Carbon($value))->format('H:i');
    }

    public function setTimeEndedAttribute($value) {
        $this->attributes['time_ended'] = (new Carbon($value))->format('H:i');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
