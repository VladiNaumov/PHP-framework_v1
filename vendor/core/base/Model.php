<?php

namespace vendor\core\base;

use vendor\core\Db;

abstract class Model
{
    protected  $pdo;

    //хранения имени таблицы с которой работает модель
    protected  $table;

    protected  $pk = 'id';

    public function __construct()
    {
        $this->pdo = Db::instance();
    }

    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }

    // этот метод выбирает все данные из таблицы
    public function findAll(): bool|array
    {
      $sql = "SELECT * FROM {$this->table}";
      return $this->pdo->query($sql);

    }

    public function findOne($id, $field = '')
    {
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";
        return $this->pdo->query($sql, [$id]);
    }

    public function finBySql($sql, $params =[]){
        return $this->pdo->query($sql, $params);
    }

    public function finLike($str, $field,$table = ''){
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ? ";
        return $this->pdo->query($sql, ['%' .$str. '%']);
    }


}