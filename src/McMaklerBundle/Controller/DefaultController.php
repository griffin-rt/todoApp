<?php
/**
 * Created by PhpStorm.
 * User: pawan
 * Date: 8/9/17
 * Time: 3:09 PM
 */

namespace McMaklerBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends FOSRestController
{
    /**
     * Action to handle create wallet.
     *
     * @Get("/")
     * @View(statusCode=200)
     *
     * @return array
     */
    public function indexAction()
    {
        return new JsonResponse(array("hello"=>"world"));
    }
}