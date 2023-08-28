<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

// use App\Service\StringFormat;
// use App\Service\SendQueue;
// use App\Service\MaklerService;
// use App\Service\StatisticService;

// use App\Dao\StockDao;
// use App\Dao\GeoDao;
// use App\Dao\MaklerDao;


class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default_index")
     */
    public function indexPage()
    {
        // redirects to the "homepage" route
        // return $this->redirectToRoute('default_home');
        // return $this->redirectToRoute('statistic_dashboard'); 
        return $this->redirectToRoute('default_home');
    }
    
    /**
     * @Route("/home", name="default_home")
     */
    public function homePage(Request $request) 
    {
        // echo $request->server->get('HTTP_HOST'); 
        // $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath(); echo $baseurl; exit;
        //$appPath = $this->getParameter('kernel.project_dir'); // project dir
        
        return $this->render('default/home.html.twig', [
        ]);

        // return $this->render('default/location.html.twig', [
        //     //'name' => $name,
        // ]);
    }

    /**
     * @Route("/search/location", name="location_search")
     */
    public function search()
    {
        return $this->render('default/location.html.twig', [
            //'name' => $name,
        ]);
    }

    /**
     * @Route("/admin/test", name="admin_test")
     */
    public function adminTest()
    {
        return $this->render('default/leadtest.html.twig', [
            'say' => 'Hello ADMIN'
        ]);    
    }

    /**
     * @Route("/support/test", name="support_test")
     */
    public function supportTest()
    {
        return $this->render('default/leadtest.html.twig', [
            'say' => 'Hello SUPPORT'
        ]);    
    }

    /**
     * @Route("/statistic/test", name="statistic_test")
     */
    public function statisticTest()
    {
        return $this->render('default/leadtest.html.twig', [
            'say' => 'Hello Statistic'
        ]);    
    }

}