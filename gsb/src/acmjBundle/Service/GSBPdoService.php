<?php
/**
 * Created by PhpStorm.
 * User: arnau
 * Date: 24/01/2019
 * Time: 10:07
 */

namespace acmjBundle\Service;
use PDO;


class GSBPdoService
{
    private $dsn;
    private $user;
    private $mdp;
    private static $db;
    

    public function __construct(\PDO $pdo){
        self::$db =$pdo;
        self::$db->query("SET CHARACTER SET utf8");
    }


    public function getLesFraisForfaits() {
        $stmt= self::$db->query('SELECT * from fraisforfait');
        $lesFF = $stmt->fetchAll();
        return $lesFF;
    }
    public function getLesInfos($id) {
        $stmt= self::$db->query("SELECT * from fichefrais where ID_DECLARER='$id'");
        $lesFF = $stmt->fetchAll();
        return $lesFF;
    }

    public function getLesInfosHorsForfait() {
        $stmt= self::$db->query("SELECT * from lignefraishorsforfait");
        $lesFF = $stmt->fetchAll();
        return $lesFF;
    }

}