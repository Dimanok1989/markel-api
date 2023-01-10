<?php

namespace App\Providers;

use App\Services\Company\CompanyService;
use App\Services\CompanyForm\CompanyFormService;
use App\Services\CompanyForm\FormInputService;
use App\Services\Interfaces\CompanyFormInterface;
use App\Services\Interfaces\CompanyInterface;
use App\Services\Interfaces\FormInputInterface;
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
        CompanyFormInterface::class => CompanyFormService::class,
        CompanyInterface::class => CompanyService::class,
        FormInputInterface::class => FormInputService::class,
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
