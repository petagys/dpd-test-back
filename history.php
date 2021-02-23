<?php
require_once 'db_connection.php';

$db = new Db();

if('GET' == $_SERVER['REQUEST_METHOD'] && isset($_GET['count'])){
    $result = array();
    $SQL = "SELECT * from results LIMIT {$_GET['count']}";
    $dbResult = $db->SQLSelect($SQL);
    if (mysqli_num_rows($dbResult) > 0) {
        while($row = mysqli_fetch_assoc($dbResult)) {
            $row['results'] = json_decode($row['results']);
            array_push($result, $row);
        }
    }
    echo json_encode($result);
    exit;
}

if('POST' == $_SERVER['REQUEST_METHOD']){

}

header('HTTP/1.1 500 Internal Server Error');
        exit('Что-то не так...');
