<?php
namespace App\Dao;

class LocationDao extends BaseDao {

    // public function getLocationByName(iterable $values) {
    //     $sql = 'SELECT id AS l_id FROM location WHERE name = :locName';
    //     return $this->doQuery($sql, $values);
    // }

    // public function insertLocation(iterable $values) {
    //     $sql = 'INSERT INTO location (name, parentid, level) VALUES (:name, :parentid, :level)';
    //     if($this->doSQL($sql, $values)){
    //         return $this->conn->lastInsertId();
    //     }
    //     return 0;
    // }

    public function searchLocationByName($searchkey){
        $sql = "SELECT id AS l_id, name AS l_name FROM location WHERE name LIKE '%".$searchkey."%'";
        return $this->doQuery($sql, []);         
    }

    // public function searchLocationByName2($searchkey){
    //     return  $this->conn->createQueryBuilder()
    //                 ->select('id AS l_id, name AS l_name')
    //                 ->from('location')
    //                 ->where('name LIKE :searchkey')
    //                 ->setParameter('searchkey', '%'.$searchkey.'%')
    //                 ->execute()
    //                 ->fetchAll();      
    // }

}