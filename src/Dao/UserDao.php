<?php
namespace App\Dao;

class UserDao extends BaseDao {

    public function getAllSupportUser(iterable $values=[]) {
        $sql = "SELECT id AS uid, email, password, roles FROM user";        
        return $this->doQuery($sql, $values);
    }

    // public function updateSupportUser(iterable $values=[]){
    //     $sql = "UPDATE user_account SET
    //             username  = :username, 
    //             email     = :email,
    //             kennwort  = :kennwort
    //             WHERE user_id = :user_id";
    //     return $this->doSQL($sql, $values);
    // }

    // public function getAllStatisticUser(iterable $values=[]) {
    //     $sql = "SELECT user_id, username, user_account.email, gesperrt, loeschung, authentifiziert, registrierungsdatum, lastlogin, user_geschaeftsstelle.name AS geschaeftsstelle
    //             FROM user_account
    //             LEFT JOIN user_geschaeftsstelle ON user_geschaeftsstelle.geschaeftsstelle_id = user_account.geschaeftsstellen_id 
    //             WHERE art_id = 4 and recht_id = 8";
    //     return $this->doQuery($sql, $values);
    // }

    // public function getStatisticUser(iterable $values=[]) {
    //     $sql = "SELECT user_id, username, user_account.email, gesperrt, loeschung, authentifiziert, registrierungsdatum, lastlogin, user_geschaeftsstelle.geschaeftsstelle_id AS geschaeftsstelleId, user_geschaeftsstelle.name AS gs_name
    //             FROM user_account
    //             LEFT JOIN user_geschaeftsstelle ON user_geschaeftsstelle.geschaeftsstelle_id = user_account.geschaeftsstellen_id 
    //             WHERE art_id = 4 and recht_id = 8 AND user_id = :user_id";
    //     return $this->doQuery($sql, $values)->fetch();
    // }

    // public function updateStatisticUser(iterable $values=[]){
    //     $sql = "UPDATE user_account SET
    //             username             = :username, 
    //             email                = :email,
    //             kennwort             = :kennwort,
    //             geschaeftsstellen_id = :geschaeftsstellen_id
    //             WHERE       user_id  = :user_id";
    //     return $this->doSQL($sql, $values);
    // }
    
    // public function insertAccountForStatisticUser(iterable $values=[]){
    //     $sql = "INSERT INTO user_account SET 
    //             art_id               = :art_id, 
    //             recht_id             = :recht_id,
    //             geschaeftsstellen_id = :geschaeftsstellen_id,
    //             kennwort             = :kennwort,
    //             username             = :username,
    //             email                = :email,
    //             registrierungsdatum  = :regdate,
    //             authentifiziert      = :authentifiziert, 
    //             gesperrt             = :gesperrt,
    //             loeschung            = :loeschung,
    //             newsletter           = :newsletter
    //             ";

    //     return $this->doSQL($sql, $values);
    // }

    // public function getUserGeschaeftsstelle(iterable $values=[]){
    //     $sql = "SELECT user_id, user_account.geschaeftsstellen_id, user_geschaeftsstelle.name 
    //             FROM user_account 
    //             INNER JOIN user_geschaeftsstelle ON  user_account.geschaeftsstellen_id = user_geschaeftsstelle.geschaeftsstelle_id
    //             WHERE user_id = :user_id";
    //     return $this->doQuery($sql, $values)->fetch();
    // }

}