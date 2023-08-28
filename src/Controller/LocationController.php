<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

// use App\Service\SearchService;
// use App\Service\LocationService;

use App\Dao\LocationDao;

/**
 * Class LocationController
 * @package App\Controller
 *
 * @Route(path="/api")
 */
class LocationController extends AbstractController
{
    /**
     * @Route("/search", name="api_location_search_by_name", methods={"GET"})
     */
    public function searchLocations(Request $request, LocationDao $ldao)
    {
        //  /api/search?lname=Bam
        $searchkey = $request->query->get('lname');
        $locations = $ldao->searchLocationByName($searchkey)->fetchAllAssociative();
        return $this->json($locations);
        // return new Response(json_encode($locations), Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

}