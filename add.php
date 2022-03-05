<?php
require_once 'headers.php';
require_once 'functions.php';

$input = json_decode(file_get_contents('php://input'));
$description = filter_var($input->description, FILTER_SANITIZE_SPECIAL_CHARS);
$amount = filter_var($input->amount, FILTER_SANITIZE_NUMBER_INT);

try {
    $db = openDB();
    $query = $db->prepare('INSERT INTO item(description, amount) VALUES (:description, :amount)');
    $query->bindValue(':description', $description, PDO::PARAM_STR);
    $query->bindValue(':amount', $amount, PDO::PARAM_INT);
    $query->execute();

    header('HTTP/1.1 200 OK');
    $data = array('id' => $db->lastInsertId(), 'description' => $description, 'amount' => $amount);
    print json_encode($data);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}