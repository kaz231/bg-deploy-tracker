<?php
namespace TrackerBundle\Controller;

use Action\Application\Command\RegisterAction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TrackerController
 * @package TrackerBundle\Controller
 * @Route("/tracker")
 */
class TrackerController extends Controller
{
    /**
     * @param Request $request
     * @Route("/track", name="tracker_track")
     * @return Response
     */
    public function trackAction(Request $request)
    {
        $this->get('command_bus')->handle(new RegisterAction(
            $request->get('action_name'),
            $request->get('action_value')
        ));

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
