<?php
namespace TrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HealthCheckController
 * @package TrackerBundle\Controller
 * @Route("/health")
 */
class HealthCheckController extends Controller
{
    /**
     * @Route("/check")
     * @return Response
     */
    public function checkAction()
    {
        return new Response('OK', Response::HTTP_OK);
    }
}
