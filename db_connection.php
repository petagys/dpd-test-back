<?php

class Db{
    public $host = 'localhost'; // адрес сервера 
    public $database = 'test'; // имя базы данных
    public $user = 'hockey'; // имя пользователя
    public $password = 'Qq654321'; // пароль
    
    
    function SQLFetchId($sql){
        $link = mysqli_connect($this->host, $this->user, $this->password, $this->database)
                or die("Ошибка при подключени к базе: " . mysqli_error($link));
        mysqli_query($link,$sql);
        $id = mysqli_insert_id($link);
        // printf ("ID новой записи: %d.\n", mysqli_insert_id($link));
        mysqli_close($link);
        return $id;
    }

    function SQLSelect($sql){
        $link = mysqli_connect($this->host, $this->user, $this->password, $this->database)
                or die("Ошибка при подключени к базе: " . mysqli_error($link));
        
        return mysqli_query($link,$sql);
    }
    
}


