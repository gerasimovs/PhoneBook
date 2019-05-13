<?php

namespace App;

use PDO;
use PDOExecption;

class Database
{
    protected $pdo;
    protected static $instance;

    protected $errors = [];

    protected function __construct()
    {
        $settings = $this->getPDOSettings();
        $this->pdo = new PDO($settings['dsn'], $settings['user'], $settings['pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }
    
    protected function getPDOSettings()
    {
        $dbConnection = getenv('DB_CONNECTION');
        $dbHost = getenv('DB_HOST');
        $dbDatabase = getenv('DB_DATABASE');

        $result['dsn'] = "{$dbConnection}:host={$dbHost};dbname={$dbDatabase};";
        $result['user'] = getenv('DB_USERNAME');
        $result['pass'] = getenv('DB_PASSWORD');

        return $result;
    }

    public function fetch($query, array $params = [])
    {
        
        if (empty($params)) {
            $stmt = $this->pdo->query($query);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function fetchAll($query, array $params = [])
    {
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($query, array $params = [])
    {
        if ($this->execute($query, $params)) {
            return $this->pdo->lastInsertId('id');
        }

        return false;
    }

    public function execute($query, array $params = [])
    {
        $result = false;

        try { 
            $stmt = $this->pdo->prepare($query);
            $result = $stmt->execute($params);
        } catch(PDOExecption $e) { 
            $this->errors[] = $e->getMessage(); 
        }

        return $result;
    }
}
