<?php

namespace vendor\core;


// класс подключение к БД
class Db
{

    protected  $pdo;
    protected static $instance;
    public static int $countSql = 0;
    public static array $queries = [];


    protected function __construct()
    {
        $db = require ROOT . '/config/config_db.php';
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE=> \PDO::FETCH_ASSOC,
        ];
        $this->pdo = new \PDO($db['dsn'],$db['user'],$db['pass'], $options);

       // $this->pdo = new \PDO('mysql:host=localhost;dbname=u1322686_demo;charset=utf8','u1322686_admin','sI3eJ2jV3bhA7j' );

    }

    public static function instance()
    {
        if (self::$instance === null){
            // $instance === null то создаём объект этого класса (class Db)
            self::$instance = new self();
            // self::$instance = new Db();
        }
        return self::$instance;
    }

    public function execute($sql)
    {
        self::$countSql++;
        self::$queries[]=$sql;

        $stmt = $this->pdo->prepare($sql);
        return $stmt -> execute();
    }

    public function query($sql)
    {
        self::$countSql++;
        self::$queries[]=$sql;

        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute();
        if($res !== false) {
            return $stmt->fetchAll();
        }
        return [];
    }

}