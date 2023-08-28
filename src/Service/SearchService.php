<?php
namespace App\Service;

// use App\Location\Entity\Location;
use App\Dao\LocationDao;

class SearchService
{
    public $dao;
    
    function __construct(LocationDao $dao) {
        $this->dao = $dao;  
    }

    // function searchLocationByName(String $searchkey) {
    //     return $this->dao->searchLocationByName($searchkey)->fetchAllAssociative();

    //     // return $this->dao->searchLocationByName(['searchkey' => "%".$searchkey."%"]);
    // }
}