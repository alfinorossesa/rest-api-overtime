<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Repositories\SettingRepositoryInterface;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    private $setting;

    public function __construct(SettingRepositoryInterface $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SettingRequest $request)
    {
        try {
            return $this->setting->setting($request);
        } catch (\Throwable $th) {
            Log::info($th);
        }
    }
}
