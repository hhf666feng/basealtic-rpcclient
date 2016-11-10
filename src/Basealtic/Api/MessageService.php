<?php
namespace Basealtic\Api;


class MessageService extends ApiBase
{

    /**
     * 发送手机验证码
     * @param string $phone 手机号
     * @return mixed
     */
    public function sendVerifyCode($phone)
    {
        return $this->client->sendRpc('/message/sendVerifyCode', ['phone' => $phone]);
    }

    /**
     * 接受手机验证码
     * @param string $phone 手机号
     * @param string $code 验证码
     * @return mixed
     */
    public function confirmVerifyCode($phone, $code)
    {
        return $this->client->sendRpc('/message/confirmVerifyCode', ['phone' => $phone, 'code' => $code]);
    }

}
