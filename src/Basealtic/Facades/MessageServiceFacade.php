<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/21
 * Time: 20:27
 */
namespace Basealtic\Facades;

use Illuminate\Support\Facades\Facade;

class MessageServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MessageService';
    }
}