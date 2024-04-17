<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
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
        JsonResponse::macro('withoutLinksMeta', function () {
            $data = $this->getData();

            if (isset($data->meta->links)) {
                unset($data->meta->links);
                $this->setData($data);
            }

            return $this;
        });
    }
}
