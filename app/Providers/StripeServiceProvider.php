<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Stripe\Stripe;

class StripeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('stripe', function ($app) {
            Stripe::setApiKey(config('services.stripe.secret'));
            return new \Stripe\StripeClient(config('services.stripe.secret'));
        });
    }
}
