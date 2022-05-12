<?php

namespace App\Repositories;

use App\Models\Reference;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingRepository implements SettingRepositoryInterface
{
    public function setting($request)
    {
        $references = Reference::where('id', $request->value)->first();

        DB::table('settings')->update([
            'key' => $request->key,
            'value' => $request->value,
            'expression' => $references->expression
        ]);

        return Setting::get();
    }
}