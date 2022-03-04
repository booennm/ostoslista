<?php
require_once 'headers.php';
require_once 'funcions.php';

$input = json_decode(file_get_contents('php://input'));
$id = filter_var($input->id, FILTER_SANITIZE_SPECIAL_CHARS);

try {
    $db = openDB();
    $query = $db->prepare('DELETE FROM item WHERE id=(:id)');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    header('HTTP/1.1 200 OK');
    $data = array('id' => $id);
    print json_encode($data);
}catch (PDOException $pdoex) {
    returnError($pdoex);
}