<?php

namespace Sioweb\Oxid\Api\Connector;

class Firewall
{
    private static $oxid_article;
    private static $oxid_user;
    private static $oxid_category;
    private static $oxid_order;

    private $secure = [
        'oxid.article' => [
            'class' => 'OxidEsales\Eshop\Application\Model\Article',
        ],
        'oxid.user' => [
            'class' => 'OxidEsales\Eshop\Application\Model\User',
        ],
        'oxid.category' => [
            'class' => 'OxidEsales\Eshop\Application\Model\Category',
        ],
        'oxid.order' => [
            'class' => 'OxidEsales\Eshop\Application\Model\Order',
        ],
    ];

    public function __construct($secure = [])
    {
        $this->secure = array_merge($this->secure, $secure);
    }

    public function __invoke($service, ...$param)
    {
        $_controller = $_GET['_controller'];
        $_GET['_controller'] = '_sioweb_oxid_api_firewall';
        $Resolved = $this->resolve($service, $param);
        $_GET['_controller'] = $_controller;

        return $Resolved;
    }

    private function resolve($service, $param)
    {
        $staticService = str_replace('.', '_', $service);
        if(!empty(static::${$staticService})) {
            return static::${$staticService};
        }

        if (empty($this->secure[$service])) {
            throw new \Exception(sprintf('Service \'%s\' is not added to secure list', $service));
        }

        if (empty($this->secure[$service]['class'])) {
            throw new \Exception(sprintf('Service \'%s\' has no executable class defined', $service));
        }

        $classname = $this->secure[$service]['class'];
        static::${$staticService} = oxNew($classname, $param);

        return static::${$staticService};
    }
}