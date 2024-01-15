<?php

class Connexion {

    private static $_instance = null;
    private PDO $linkpdo;

    private function __construct() {
        try {
            $this->linkpdo = new PDO("mysql:host=db_project;dbname=cabinet", "default",'iutinfo');
            }
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getInstance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new Connexion();
        }
        return self::$_instance;
    }

    public function getPDO() : PDO {
        return $this->linkpdo;
    }
}

?>