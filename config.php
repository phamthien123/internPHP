<?php

$hostname = 'localhost';

$username = 'root';

$password = '';

function testdb_connect($hostname, $username, $password)
{
    $conn = new PDO("mysql:host=$hostname;dbname=intern", $username, $password);
    return $conn;
}

try {
    $conn = testdb_connect($hostname, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>