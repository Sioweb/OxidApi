<?php

namespace Sioweb\Oxid\Api\Connector;

class Firewall
{
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

    public function __invoke($service, ...$param)
    {
        return $this->resolve($service, $param);
    }

    private function resolve($service, $param)
    {
        if (empty($this->secure[$service])) {
            throw new Exception(sprintf('Service \'%s\' is not added to secure list', $service));
        }

        if (empty($this->secure[$service]['class'])) {
            throw new Exception(sprintf('Service \'%s\' has no executable class defined', $service));
        }

        $classname = $this->secure[$service]['class'];
        return oxNew($classname);
    }
}