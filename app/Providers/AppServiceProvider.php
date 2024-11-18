<?php

namespace App\Providers;

use App\Contracts\Interfaces\CompanyInterface;
use App\Contracts\Interfaces\EmployeeInterface;
use App\Contracts\Interfaces\ManagerInterface;
use App\Contracts\Repositories\CompanyRepository;
use App\Contracts\Repositories\EmployeeRepository;
use App\Contracts\Repositories\ManagerRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private array $register = [
        CompanyInterface::class => CompanyRepository::class,
        ManagerInterface::class => ManagerRepository::class,
        EmployeeInterface::class => EmployeeRepository::class
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->register as $interface => $repository) $this->app->bind($interface, $repository);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
