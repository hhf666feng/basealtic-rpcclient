<?php namespace Basealtic\Rpc;

use Basealtic\Api\UserService;
use Basealtic\Facades\UserServiceFacade;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class RpcClientServiceProvider extends LaravelServiceProvider
{
    protected $defer = false;

    public function boot()
    {

        $this->handleConfigs();

    }

    public function register()
    {
        $this->app->singleton('UserService', function () {
            $client = new RpcClient();
            return new UserService($client);
        });
        $this->app->alias('UserService', UserServiceFacade::class);
    }


    public function provides()
    {

        return ['UserService'];
    }

    private function handleConfigs()
    {

        $configPath = __DIR__ . '/../config/rpcclient.php';

        $this->publishes([$configPath => config_path('rpcclient.php')]);

        $this->mergeConfigFrom($configPath, 'rpcclient');
    }

}
