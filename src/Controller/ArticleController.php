<?php

declare (strict_types = 1);

namespace Sioweb\Oxid\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sioweb\Oxid\Api\Connector\Firewall;

class ArticleController extends Controller
{
    public function indexAction()
    {
        ini_set('memory_limit', '800M');
        ini_set('max_execution_time', '120');
        $Firewall = new Firewall;
        return new JsonResponse(iterator_to_array($Firewall('oxid.article')->fetchAll()));
    }

    public function newAction()
    {
        die("<pre>" . print_r('new Article', true));
    }

    public function showAction()
    {
        die("<pre>" . print_r('show Article', true));
    }

    public function updateAction()
    {
        die("<pre>" . print_r('update Article', true));
    }

    public function deleteAction()
    {
        die("<pre>" . print_r('delete Article', true));
    }

}