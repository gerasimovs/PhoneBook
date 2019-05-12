<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$filename = __DIR__ . '/database/dump.sql';
$errorFilename = $filename . '.error';

(file_exists($filename) && $fp = fopen($filename, 'r')) or die('Failed to open file: ' . $filename);

$dbConnection = getenv('DB_CONNECTION');
$dbHost = getenv('DB_HOST');
$dbDatabase = getenv('DB_DATABASE');
$dbUsername = getenv('DB_USERNAME');
$dbUsername = getenv('DB_USERNAME');
$dbPassword = getenv('DB_PASSWORD');

$conn = new PDO("{$dbConnection}:host={$dbHost};dbname=$dbDatabase", $dbUsername, $dbPassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);         
$conn->exec("SET CHARACTER SET utf8");     

$queryCount = 0;
$query = '';
while ($line = fgets($fp, 1024000)) {
    if (substr($line, 0, 2) == '--' || trim($line) == '') {
        continue;
    }

    $query .= $line;
    if (substr(trim($query),-1) == ';') {
        $prepare = $conn->prepare($query);

        if (!($prepare->execute())){ 
            $error = "Error performing query '{$query}': {$conn->errorInfo()}" . PHP_EOL;
            file_put_contents($errorFilename, $error);
            echo $error;
            exit;
        }

        $query = '';
        $queryCount++;
    }
}

if (feof($fp)) {
    echo 'Dump successfully restored! Queries: ' . $queryCount . PHP_EOL;
}