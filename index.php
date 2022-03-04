<?php
require_once 'headers.php';
require_once 'functions.php';

try {
    $db = openDB();
    $sql = "SELECT * FROM task";
    $query = $db->query($sql);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    header('HTTP/1.1 200 OK');
    print json_encode($results);
}catch(PDOException $pdoex) {
    returnError($pdoex);
}