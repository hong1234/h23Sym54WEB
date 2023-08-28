<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// use App\Validator\UserAccount;
// use App\Service\StringFormat;
use App\Service\UserService;

// use App\Dao\UserDao;
use App\Dao\UserLoginDao;

/**
 *
 * @Route(path="/admin")
 */
class SupporterController extends AbstractController
{
    // private $uDao;
    // private $supService;
    
    // public function __construct(UserDao $uDao, SupporterService $supService)
    // {
    //     $this->uDao = $uDao;
    //     $this->supService = $supService;
    // }

    /**
     * @Route("/supporter", name="supporter_list")
     */
    public function supporterList(UserService $supService) {
        $rows = $supService->SupporterList();
        return $this->render('supporter/list.html.twig', [
            'dataSet' => $rows
        ]);
    }

    /**
     * @Route("/supporter/new", name="supporter_new")
     */
    public function newSupporter(Request $request, UserLoginDao $loginDao)
    {
        $error = '';

        if ($request->isMethod('POST') && $request->request->get('savebutton')) {

            $safePost = $request->request;
            //validation
            // $error = $validator->isValidSupporterInput($safePost);

            if ($error == '') {

                // $this->supService->newSupporter($safePost);

                $email    = $safePost->get('email');
                $passwort = $safePost->get('passwort');
                $roles    = ['ROLE_SUPPORT'];

                $loginDao->addLoginUser($email, $passwort, $roles);

                return $this->redirectToRoute('supporter_list', [
                    //'paramName' => 'value'
                ]);   

                // return $this->redirectToRoute('default_home', [
                //     //'paramName' => 'value'
                // ]);
            }
            
            // $username = $safePost->get('username');
            $email    = $safePost->get('email');
            $passwort = $safePost->get('passwort');

        }

        if ($request->isMethod('GET')) {
            // $username = '';
            $email    = '';
            $passwort = ''; //$sfService->getRandPassWord();
            $error    = '';
        }

        return $this->render('supporter/new.html.twig', [
            // 'username' => $username,
            'email'    => $email,
            'passwort' => $passwort,
            'error'    => $error
        ]);
    }


    /**
     * @Route("/supporter/{uid}/delete", name="supporter_delete", requirements={"uid"="\d+"})
     */
    public function supporterDelete($uid, UserLoginDao $loginDao)
    {
        $loginDao->deleteLoginUser($uid);
        return $this->redirectToRoute('supporter_list', [
            //'paramName' => 'value'
        ]);
        
    }
}