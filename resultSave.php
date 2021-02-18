<?php
require_once 'db_connection.php';

if ('application/json' == $_SERVER['CONTENT_TYPE'] && 'POST' == $_SERVER['REQUEST_METHOD']) {
    $json = json_decode(file_get_contents('php://input'), true);
    if(!isset($json['result']) || !isset($json['name']) || !isset($json['surname']) || !isset($json['email'])){
        header('HTTP/1.1 500 Internal Server Error');
        exit('Не получил какие-то данные...');
    }
    date_default_timezone_set("Europe/Moscow");
    $date = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
    $results = json_encode($json['result']);
    // echo $results;
    $SQL = "INSERT INTO results (name, surname, email, results, date) 
    VALUES ('{$json['name']}', '{$json['surname']}', '{$json['email']}', '{$results}', '{$date}')";

    $db = new Db();
    $id = $db->SQLFetchId($SQL);

    $array = new ArrayObject();
    foreach(json_decode($results) as $key => $value){
        $newSQL = "SELECT name, text FROM result_description WHERE name = '{$key}' AND min <= {$value} AND max >= {$value}";
        $newResult = $db->SQLSelect($newSQL);
        if (mysqli_num_rows($newResult) > 0) {
            while($row = mysqli_fetch_assoc($newResult)) {
              $array[$row['name']] = $row['text'];
            }
          }
    }
    // $array['id'] = $id ? $id : null;
    echo json_encode($array);
}