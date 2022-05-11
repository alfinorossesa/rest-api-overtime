<?php

namespace App\Repositories;

use App\Exceptions\SettingKeyNotMatch;
use App\Exceptions\SettingValueNotMatch;
use App\Models\Reference;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingRepository implements SettingRepositoryInterface
{
    public function setting($request)
    {
        if (!Reference::where('id', $request->value)->where('code', 'overtime_method')->exists()) {
            throw new SettingValueNotMatch;
        } elseif ($request->key !== 'overtime_method') {
            throw new SettingKeyNotMatch;
        }

        $references = Reference::where('id', $request->value)->first();

        DB::table('settings')->update([
            'key' => $request->key,
            'value' => $request->value,
            'expression' => $references->expression
        ]);

        return Setting::get();
    }
}