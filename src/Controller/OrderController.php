<?php

declare (strict_types = 1);

namespace Sioweb\Oxid\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderController
{
    public function indexAction()
    {
        die("<pre>" . print_r('index Order', true));
    }

    public function newAction()
    {
        die("<pre>" . print_r('new Order', true));
    }

    public function showAction()
    {
        die("<pre>" . print_r('show Order', true));
    }

    public function updateAction()
    {
        die("<pre>" . print_r('update Order', true));
    }

    public function deleteAction()
    {
        die("<pre>" . print_r('delete Order', true));
    }

}