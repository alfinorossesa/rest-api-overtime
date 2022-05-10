<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'status_id');
    }

    public function setting()
    {
        return $this->hasOne(Setting::class, 'value');
    }
}
