<?php

namespace App\Repositories;

use App\Models\Reference;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingRepository implements SettingRepositoryInterface
{
    public function setting($request)
    {
        if (!Reference::where('id', $request->value)->where('code', 'overtime_method')->exists()) {
            return response()->json(['error' => 'value given not match'], 404);
        } elseif ($request->key !== 'overtime_method') {
            return response()->json(['error' => 'key must overtime_method'], 422);
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