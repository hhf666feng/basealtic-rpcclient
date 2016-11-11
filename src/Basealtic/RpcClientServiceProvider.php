<?php namespace Basealtic\Rpc;

use Basealtic\Api\MessageService;
use Basealtic\Api\UserService;
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
        $client = new RpcClient();
        $this->app->singleton('UserService', function () use ($client) {
            return new UserService($client);
        });
        $this->app->singleton('MessageService', function () use ($client) {
            return new MessageService($client);
        });
    }


    public function provides()
    {

        return ['UserService', 'MessageService'];
    }

    private function handleConfigs()
    {

        $configPath = __DIR__ . '/../../config/rpcclient.php';

        $this->publishes([$configPath => config_path('rpcclient.php')]);

        $this->mergeConfigFrom($configPath, 'rpcclient');
    }

}
