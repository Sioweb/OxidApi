<?php

namespace Sioweb\Oxid\Api\Core;

class ShopControll extends ShopControll_parent
{
    public function start($controllerKey = null, $function = null, $parameters = null, $viewsChain = null)
    {
        return parent::start($controllerKey, $function, $parameters, $viewsChain);
    }
}