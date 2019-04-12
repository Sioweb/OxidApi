<?php

declare (strict_types = 1);

namespace Sioweb\Oxid\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController
{
    public function indexAction()
    {
        die("<pre>" . print_r('index User', true));
    }

    public function newAction()
    {
        die("<pre>" . print_r('new User', true));
    }

    public function showAction()
    {
        die("<pre>" . print_r('show User', true));
    }

    public function updateAction()
    {
        die("<pre>" . print_r('update User', true));
    }

    public function deleteAction()
    {
        die("<pre>" . print_r('delete User', true));
    }

}