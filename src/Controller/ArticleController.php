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
        $Firewall = new Firewall;
        // die("<pre>" . print_r($this->getDoctrine(), true));
        $Article = $Firewall('oxid.article');
        $Article->fetchAll();
        
        $this->getDoctrine()->getManager();
        die("<pre>" . print_r('index Article', true));
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