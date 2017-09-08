<?php
/**
 * Created by PhpStorm.
 * User: pawan
 * Date: 8/9/17
 * Time: 3:04 PM
 */
namespace McMaklerBundle\Controller\API;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;



class APIController extends BaseController{


    /**
     * Action to fetch hazardous meteoroids
     *
     * @Get("/hazardous/{_locale}.{_format}")
     * @View(statusCode=200)
     *
     * @ApiDoc(
     *  resource=false,
     *  section="Consumer",
     *  description="API used to fetch meteor details",
     *  requirements={
     *      {
     *          "name"="_locale",
     *          "dataType"="string",
     *          "requirement"="en|my",
     *          "description"="Locale"
     *      },
     *      {
     *          "name"="_format",
     *          "dataType"="string",
     *          "requirement"="json",
     *          "description"="Response format"
     *      },
     *  },
     *  parameters={
     *      {"name"="content",
     *      "dataType"="Json",
     *      "required"="true",
     *      "descripton":"Request format to get hazardous meteoroid info",
     *      "format"=""
     *       },
     *   },
     *  statusCodes={
     *         200="Returned when successful",
     *         401="Returned when not authorized",
     *  }
     * )
     *
     * @return array
     */
    public function hazardousAction(Request $request)
    {
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        $neoRepo = $em->getRepository('McMaklerBundle:Neo');

        $hazardous = $neoRepo->findBy(
            array(
                "isPotentiallyHazardousAsteroid" => true
            )
        );

        return $hazardous;
    }


}