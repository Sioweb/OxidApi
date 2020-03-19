<?php

declare (strict_types = 1);

namespace Sioweb\Oxid\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController
{
    public function indexAction()
    {
        return new JsonResponse([
            'error' => 404,
            'message' => 'No routes where found for this api call!'
        ]);
    }
}
