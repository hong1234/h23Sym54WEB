<?php
namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use App\Dao\UserDao;
// use App\Dao\UserLoginDao;
// use App\Service\SendQueue;

class UserService
{
    private $uDao;
    private $router;
    
    function __construct(UserDao $uDao, UrlGeneratorInterface $router) {
        $this->uDao = $uDao; 
        $this->router = $router;
    }

    public function SupporterList() {

        $rs = $this->uDao->getAllSupportUser();

        $rows = array();
        while ($row = $rs->fetchAssociative()) {
            $row2 = array();
            $row2[] = $row['uid'];
            $row2[] = $row['email'];
            $row2[] = $row['password'];
            $row2[] = $row['roles'];
            // $row2[] = date("Y-m-d", (int)$row['registrierungsdatum']);
            // $row2[] = date("Y-m-d", (int)$row['lastlogin']);
            // $row2[] = "<a href=".$this->router->generate('supporter_edit', array('uid' => $row['user_id'])).">Daten bearbeiten</a>";
            $row2[] = "<a href=".$this->router->generate('supporter_delete', array('uid' => $row['uid'])).">Supporter löschen</a>";
            
            $rows[] = $row2;
        }

        return $rows;
    }
}