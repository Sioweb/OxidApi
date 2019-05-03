<?php

declare (strict_types = 1);

namespace Sioweb\Oxid\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sioweb\Oxid\Api\Connector\Firewall;

class ArticleController extends Controller
{

    /**
     * @Scope("Test")
     */
    public function indexAction()
    {
        ini_set('memory_limit', '800M');
        ini_set('max_execution_time', '120');
        $Firewall = new Firewall;
        // die('<pre>' . print_r($Firewall('oxid.user'), true));
        return new JsonResponse(iterator_to_array($Firewall('oxid.article')->fetchAll()));
    }

    public function newAction()
    {
        return new JsonResponse([
            'status' => 'new article'
        ]);
    }

    public function showAction($item)
    {
        $Firewall = new Firewall;
        return new JsonResponse([
            'article' => iterator_to_array($Firewall('oxid.article')->fetch($item), true)
        ]);
    }

    public function updateAction()
    {
        return new JsonResponse([
            'status' => 'update Article'
        ]);
    }

    public function deleteAction()
    {
        return new JsonResponse([
            'status' => 'delete Article'
        ]);
    }

}