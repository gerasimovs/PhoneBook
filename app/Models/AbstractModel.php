<?php

namespace App\Models;

use App\Database;

abstract class AbstractModel
{
    protected $db;
    protected $attributes = [];

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function all()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        return $this->db->fetchAll($query);
    }

    public function create($attributes)
    {
        $columns = array_keys($attributes);
        $columnsToString = implode(', ', $columns);

        $placeholders = array_map(function($column) {
            return ":{$column}";
        }, $columns);
        $placeholdersToString = implode(', ', $placeholders);

        $query = "INSERT INTO {$this->table} ({$columnsToString}) VALUES ({$placeholdersToString})";
        return $this->db->insert($query, $attributes);
    }

    public function update($id, $attributes)
    {
        $columns = array_keys($attributes);
        $columnsWithPlaceholders = array_map(function($column) {
            return "{$column} = :{$column}";
        }, $columns);
        $placeholdersToString = implode(', ', $columnsWithPlaceholders);

        $query = "UPDATE  {$this->table} SET {$placeholdersToString} WHERE id = :id";
        return $this->db->execute($query, $attributes + ['id' => (int) $id]);
    }

    public function find($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        return $this->db->fetch($query, ['id' => (int) $id]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        return $this->db->execute($query, compact('id'));
    }

}