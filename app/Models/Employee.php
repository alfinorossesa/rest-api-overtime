<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status_id', 'salary'];
    public $timestamps = false;

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'status_id');
    }

    public function overtime()
    {
        return $this->hasMany(Overtime::class, 'employee_id');
    }

}
