<?php

namespace App\Providers;

use App\Repositories\EmployeeRepository;
use App\Repositories\EmployeeRepositoryInterface;
use App\Repositories\OvertimeRepository;
use App\Repositories\OvertimeRepositoryInterface;
use App\Repositories\SettingRepository;
use App\Repositories\SettingRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(OvertimeRepositoryInterface::class, OvertimeRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
