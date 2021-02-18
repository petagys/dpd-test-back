<?php
require_once 'db_connection.php';


if ('application/json' == $_SERVER['CONTENT_TYPE'] && 'POST' == $_SERVER['REQUEST_METHOD']) {
    $json = json_decode(file_get_contents('php://input'), true);
    if(!isset($json['name']) || !isset($json['surname']) || !isset($json['email'])){
        header('HTTP/1.1 500 Internal Server Error');
        exit('Не получил какие-то данные...');
    }
    $SQL = "INSERT INTO contacts (name, surname, email) VALUES ('{$json['name']}', '{$json['surname']}', '{$json['email']}')";

    $db = new Db();
    $result = $db->SQLFetchId($SQL);
    echo $result;
    // $_REQUEST['JSON'] = json_decode(file_get_contents('php://input'), true);
    // $_POST['JSON'] = & $_REQUEST['JSON'];
}

// $fio = json_decode(file_get_contents('php://input'), true);
// echo json_encode($_POST['JSON']);
// echo json_decode(file_get_contents('php://input'), true);;
// echo file_get_contents('php://input');
// echo post_max_size;

// $db = new Db();

// $res = $db->getResultsFromDb('SELECT * from test');
// while($row = mysqli_fetch_assoc($res)) { 
//     echo $row['test'];
// }



//define("DB_SERVER", "localhost");
//define("DB_USER", "root");
//define("DB_PASSWORD", "");
//define("DB_DATABASE", "databasename");
//$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

//$link = mysqli_connect($host, $user, $password, $database) 
//    or die("Ошибка " . mysqli_error($link));
//
//$res = mysqli_query($link, 
//        "SELECT * from test"
//        );
//
//while($row = mysqli_fetch_assoc($res)) { // закончили на 11-ой записи
//    echo $row['test'];
//}
//
//
//
//mysqli_close($link);
