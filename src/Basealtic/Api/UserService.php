<?php
namespace Basealtic\Api;


class UserService extends ApiBase
{

    /**
     * 根据用户ID获取用户信息
     * @param integer $userId 用户ID
     * @return User 用户信息
     */
    public function getUserById($userId)
    {
        return $this->client->sendRpc('/user/getUserById', ['userId' => $userId]);
    }

    /**
     * 检测用户的密码
     * @param integer $userId 用户ID
     * @param string $password 密码
     * @return bool 是否通过
     */
    public function checkPassword($userId, $password)
    {
        return $this->client->sendRpc('/user/checkPassword', ['userId' => $userId, 'password' => $password]);
    }

    /**
     * 修改用户密码
     * @param integer $userId 用户ID
     * @param string $password 密码
     * @return bool 是否修改成功
     */
    public function changePassword($userId, $password)
    {
        return $this->client->sendRpc('/user/changePassword', ['userId' => $userId, 'password' => $password]);

    }

    /**
     * 根据用户手机号获取用户信息
     * @param string $phone 手机号码
     * @return User 用户信息
     */
    public function getUserByPhone($phone)
    {
        return $this->client->sendRpc('/user/getUserByPhone', ['phone' => $phone]);
    }

    /**
     * 修改用户基本信息
     * @param integer $userId 用户ID
     * @param string $userInfo Json字符串。用户信息
     * @return bool 是否修改成功
     */
    public function editInfo($userId, $userInfo)
    {
        return $this->client->sendRpc('/user/editInfo', ['userId' => $userId, 'userInfo' => $userInfo]);

    }

    /**
     * 创建新用户
     * @param string $userInfo Json字符串。用户信息
     * @return bool 是否创建成功
     */
    public function create($userInfo)
    {
        return $this->client->sendRpc('/user/create', ['userInfo' => $userInfo]);

    }

    /**
     * 获取用户基本信息，以及商家额外信息
     * @param integer $userId 用户ID
     * @return User 用户信息
     */
    public function getUserInfoWithBusinessExtra($userId)
    {
        return $this->client->sendRpc('/user/getUserInfoWithBusinessExtra', ['userId' => $userId]);
    }

    /**
     * 获取用户基本信息，以及媒体额外信息
     * @param integer $userId 用户ID
     * @return User 用户信息
     */
    public function getUserInfoWithMediaExtra($userId)
    {
        return $this->client->sendRpc('/user/getUserInfoWithMediaExtra', ['userId' => $userId]);
    }


}
