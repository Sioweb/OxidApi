<?php

declare (strict_types = 1);

namespace Sioweb\Oxid\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleController
{
    public function indexAction()
    {
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