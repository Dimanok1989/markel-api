<?php

namespace App\Providers;

use App\Repositories\CompanyFormInputRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\Interfaces\CompanyFormInputRepositoryInterface;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Все связывания контейнера, которые должны быть зарегистрированы.
     *
     * @var array
     */
    public $bindings = [
        CompanyFormInputRepositoryInterface::class => CompanyFormInputRepository::class,
        CompanyRepositoryInterface::class => CompanyRepository::class,
        UserRepositoryInterface::class => UserRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
