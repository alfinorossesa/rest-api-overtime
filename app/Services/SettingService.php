<?php

namespace App\Services;

use App\Exceptions\SettingKeyNotMatch;
use App\Exceptions\SettingValueNotMatch;
use App\Models\Reference;
use App\Repositories\SettingRepositoryInterface;

class SettingService
{
    protected $setting;
    public function __construct(SettingRepositoryInterface $setting)
    {
        $this->setting = $setting;
    }

    public function changeSetting($request)
    {
        if (!Reference::where('id', $request->value)->where('code', 'overtime_method')->exists()) {
            throw new SettingValueNotMatch();
        } elseif ($request->key !== 'overtime_method') {
            throw new SettingKeyNotMatch();
        }

        return $this->setting->setting($request);
    }
}