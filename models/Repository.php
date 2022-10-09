<?php

namespace app\models;

use app\engine\Db;

abstract class Repository
{
    abstract protected function getTableName();
    abstract protected function getEntityClass();

    public function insert(Entity $entity) {

        $params = [];
        $columns = [];

        foreach ($entity->props as $key => $value) {
            $params[":{$key}"] = $entity->$key;
            $columns[] = $key;
        }

        $columns = implode(', ', $columns);
        $value = implode(', ', array_keys($params));

        $tableName = $this->getTableName();

        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$value})";

        DB::getInstance()->execute($sql, $params);

        $entity->id = DB::getInstance()->lastInsertId();

        return $entity->id;
    }

    public function getOneWhere($name, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$name}`=:value";
        return Db::getInstance()->queryOneObject($sql, ['value' => $value], $this->getEntityClass());
    }

    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        //return Db::getInstance()->queryOne($sql, ['id' => $id]);
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function getAll() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

}