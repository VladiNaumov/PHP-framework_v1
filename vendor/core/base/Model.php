<?php

namespace vendor\core\base;

use vendor\core\Db;

abstract class Model
{
    protected  $pdo;

    //хранения имени таблицы с которой работает модель
    protected $table;

    public function __construct()
    {
        $this->pdo = Db::instance();
    }

    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }

    // этот метод выбирает все данные из таблицы
    public function findAll()
    {
      $sql = "SELECT * FROM {$this->table}";
      return $this->pdo->query($sql);

    }

}