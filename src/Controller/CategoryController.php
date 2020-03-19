<?php

declare (strict_types = 1);

namespace Sioweb\Oxid\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sioweb\Oxid\Api\Connector\Firewall;

class CategoryController
{
    public function indexAction()
    {
        ini_set('memory_limit', '800M');
        ini_set('max_execution_time', '120');
        $Firewall = new Firewall;
        return new JsonResponse(iterator_to_array($Firewall('oxid.category')->fetchAll()));
    }

    public function newAction()
    {
        die("<pre>" . print_r('new Category', true));
    }

    public function showAction($item)
    {
        $Firewall = new Firewall;
        return new JsonResponse([
            'article' => iterator_to_array($Firewall('oxid.category')->fetch($item), true)
        ]);
    }

    public function updateAction()
    {
        die("<pre>" . print_r('update Category', true));
    }

    public function deleteAction()
    {
        die("<pre>" . print_r('delete Category', true));
    }

}