<?php
namespace Basealtic\V1;

use \Basealtic\Rpc\RpcClient;

class ApiBase
{
    protected $client;

    public function __construct(RpcClient $client)
    {
        $this->client = $client;
        $this->client->rpc_version = config('rpcclient.rpc_version');
        $this->client->app_id = config('rpcclient.app_id');
        $this->client->app_secret = config('rpcclient.app_secret');
        $this->client->sign_method = config('rpcclient.sign_method');
        $this->client->rpc_url = config('rpcclient.rpc_url');
    }


}
