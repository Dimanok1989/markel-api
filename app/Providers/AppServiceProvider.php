<?php

namespace App\Providers;

use App\Services\Company\CompanyService;
use App\Services\Interfaces\CompanyInterface;
use App\Services\Phones\PhoneService;
use App\Services\Phones\PhoneServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Все связывания контейнера, которые должны быть зарегистрированы.
     *
     * @var array
     */
    public $bindings = [
        CompanyInterface::class => CompanyService::class,
        PhoneServiceInterface::class => PhoneService::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
