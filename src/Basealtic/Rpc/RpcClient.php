<?php
namespace Basealtic\Rpc;

use Illuminate\Support\Str;

class RpcClient
{
    public $rpc_version = '2.0';
    public $app_id;
    public $app_secret;
    public $sign_method;
    public $rpc_url;
    public $api_version;

    function __construct()
    {
    }

    public function getAppId()
    {
        return $this->app_id;
    }

    public function sendRpc($url, $params = null)
    {
        $_params = [
            "jsonrpc" => $this->rpc_version,
            "app_id" => $this->app_id,
            "sign_method" => $this->sign_method,
            "nonce" => Str::random(),
            "id" => Str::random(),
            "url" => $url,
            "method" => $url,
        ];
        if (isset($params)) $_params['params'] = $params;
        $sign = $this->generateSign($_params);
        $_params['sign'] = $sign;

        $client = new \GuzzleHttp\Client();
        $ret = $client->post($this->rpc_url . '/' . $this->api_version . $_params['url'],
            [
                'headers' => [
                    'User-Agent' => $_SERVER['HTTP_USER_AGENT']
                ],
                'form_params' => $_params
            ]
        );
        $ret = json_decode($ret->getBody()->getContents(), true);
        return $ret;
    }

    /**
     * 生成签名
     * @param  array $params 待校验签名参数
     * @return string|false
     */
    private function generateSign($params)
    {
        if ($this->sign_method == 'md5')
            return $this->generateMd5Sign($params);
        return false;

    }

    private function getSortParamsString($params)
    {
        ksort($params);
        return $this->app_secret . $this->multiArray2String($params) . $this->app_secret;
    }

    private function multiArray2String($array)
    {
        $result_array = '';
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->multiArray2String($value);
            } else
                $result_array .= $key . $value;
        }
        return $result_array;
    }

    /**
     * md5方式签名
     * @param  array $params 待签名参数
     * @return string
     */

    private function generateMd5Sign($params)
    {
        return strtoupper(md5($this->getSortParamsString($params)));
    }
}