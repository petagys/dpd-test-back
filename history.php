<?php
require_once 'db_connection.php';
ini_set("display_errors", 1);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

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
    $json = json_decode(file_get_contents('php://input'), true);
    $SQL1 = "SELECT * FROM results WHERE ";
    $conditions = [];
    if($json['name']){
        $conditions.array_push($conditions, "(`name` like '{$json['name']}%' or `surname` like '{$json['name']}%')");
    }
    if(!empty($json['email'])){
        $conditions.array_push($conditions, "`email` like '%{$json['email']}%'");
    }
    if(!empty($json['from'])){
        $conditions.array_push($conditions, "`date` >= '{$json['from']}'");
    }
    if(!empty($json['to'])){
        $conditions.array_push($conditions, "`date` <= '{$json['to']}'");
    }
    foreach($conditions as $key => $val){
        $SQL1 .= $val;
        if($key !== count($conditions) - 1){
            $SQL1 .= ' and ';
        }
    }
    $result = array();
    // echo $SQL1;
    $dbResult = $db->SQLSelect($SQL1);
    if (mysqli_num_rows($dbResult) > 0) {
        while($row = mysqli_fetch_assoc($dbResult)) {
            $row['results'] = json_decode($row['results']);
            array_push($result, $row);
        }
    }
    echo json_encode($result);
    exit;
}

header('HTTP/1.1 500 Internal Server Error');
        exit('Что-то не так...');
