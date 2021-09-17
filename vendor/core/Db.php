<?php

namespace vendor\core;


// класс подключение к БД
class Db
{

    protected $pdo;
    protected static $instance;


    protected function __construct()
    {
        $db = require ROOT . '/config/config_db.php';
        $this->pdo = new \PDO($db['dsn'],$db['user'],$db['pass']);

       // $this->pdo = new \PDO('mysql:host=localhost;dbname=u1322686_demo;charset=utf8','u1322686_admin','sI3eJ2jV3bhA7j' );

    }

    public static function instance(){
        if (self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function execute($sql){
        $stmt = $this->pdo-prepare($sql);
        return $stmt -> execute();
    }

    public function query($sql){
        $stmt = $this->pdo-prepare($sql);
        $res = $stmt->execute();
        if($res !== false) {
            return $stmt->fetchAll();
        }
        return [];
    }

}