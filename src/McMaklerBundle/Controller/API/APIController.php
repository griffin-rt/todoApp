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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class APIController extends BaseController
{
    /**
     * Action to fetch hazardous asteroid
     *
     * @Get("/hazardous/{_locale}.{_format}")
     * @View(statusCode=200)
     *
     * @ApiDoc(
     *  resource=false,
     *  section="Consumer",
     *  description="Action to fetch hazardous asteroid",
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
     *      "descripton":"Request format to get hazardous asteroid info",
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


    /**
     * Action to fetch fastest asteroid
     *
     * @Get("/fastest/{_locale}.{_format}")
     * @View(statusCode=200)
     *
     * @ApiDoc(
     *  resource=false,
     *  section="Consumer",
     *  description="Action to fetch fastest asteroid",
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
     *      "descripton":"Request format to get fastest asteroid info",
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
    public function fastestAsteroidAction(Request $request)
    {
        $params = explode("=", trim($request->getQueryString()));
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        $neoRepo = $em->getRepository('McMaklerBundle:Neo');

        if (strcmp($params[0], "hazardous") == 0) {
            $result = $neoRepo->getfastetAsteroid($params[1]);
        }
        return $result;
    }


    /**
     * Action to get year with most asteroids
     *
     * @Get("/best-year/{_locale}.{_format}")
     * @View(statusCode=200)
     *
     * @ApiDoc(
     *  resource=false,
     *  section="Consumer",
     *  description="Action to get year with most asteroids",
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
     *      "descripton":"Request to get year with most asteroids",
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
    public function bestYearAction(Request $request){
        $params = explode("=", trim($request->getQueryString()));
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        $neoRepo = $em->getRepository('McMaklerBundle:Neo');

        if (strcmp($params[0], "hazardous") == 0) {
            $result = $neoRepo->getbestYear($params[1]);
        }
        return $result;
    }


    /**
     * Action to get month with most asteroids
     *
     * @Get("/best-month/{_locale}.{_format}")
     * @View(statusCode=200)
     *
     * @ApiDoc(
     *  resource=false,
     *  section="Consumer",
     *  description="Action to get month with most asteroids",
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
     *      "descripton":"Request format to get month with most asteroids",
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
    public function bestMonthAction(Request $request){
        $params = explode("=", trim($request->getQueryString()));
        $doctrine = $this->container->get('doctrine');
        $em = $doctrine->getManager();
        $neoRepo = $em->getRepository('McMaklerBundle:Neo');

        if (strcmp($params[0], "hazardous") == 0) {
            $result = $neoRepo->getbestMonth($params[1]);
        }
        return $result;
    }

}