<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = ['key', 'value', 'expression'];
    protected $primaryKey = null;
    public $incrementing = false;

    public function reference()
    {
        return $this->belongsTo(Reference::class, 'value');
    }
}
