<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Sale;
use App\Policies\ClientPolicy;
use App\Policies\OrderPolicy;
use App\Policies\SalePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Client::class => ClientPolicy::class,
        Order::class  => OrderPolicy::class,
        Sale::class   => SalePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}

