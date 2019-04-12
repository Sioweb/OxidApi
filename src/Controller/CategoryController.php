<?php

declare (strict_types = 1);

namespace Sioweb\Oxid\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController
{
    public function indexAction()
    {
        die("<pre>" . print_r('index Category', true));
    }

    public function newAction()
    {
        die("<pre>" . print_r('new Category', true));
    }

    public function showAction()
    {
        die("<pre>" . print_r('show Category', true));
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