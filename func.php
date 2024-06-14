<?php

function DbConnect($server_adress, $user_name, $password, $dbname)
{
    $link = mysqli_connect($server_adress, $user_name, $password, $dbname);

    if ($link == false){
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    }
    else {
        //print("Соединение установлено успешно");
    }

    mysqli_set_charset($link, "utf8");

    return ($link);
}

function InsertUser($link, $tbName, $login, $password, $name = null, $lastname = null, bool $sex = null, $dob = null)
{
    $sql = "INSERT INTO $tbName (login, password, name, lastname, sex, dob) VALUES ('$login', '$password', '$name', '$lastname', '$sex', '$dob')";

    $result = mysqli_query($link, $sql);

    if ($result == false) {
        print("Произошла ошибка при выполнении запроса");
    }
    else {
        print("Данные успешно добавлены");
    }
}

function OutputUsers ($link, $tbName, $sort, $art, $kol)
{
    $sql = "SELECT * FROM $tbName ORDER BY $sort LIMIT $art,$kol";
    $result = mysqli_query($link, $sql);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    $res = mysqli_query($link, "SELECT COUNT(*) FROM $tbName");
    $row = mysqli_fetch_row($res);
    $total = $row[0]; // всего записей
    $str_pag = ceil($total / $kol);
    array_unshift($rows, $str_pag);
    return ($rows);

    /*foreach ($rows as $row) {
        print("Город: " . $row['name'] . "; Идентификатор: . " . $row['id'] . "<br>");
    }*/
}

function FindUserByLogin ($link, $tbName, $login)
{
    $sql = "SELECT * FROM $tbName WHERE login = '$login'";
    $result = mysqli_query($link, $sql);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return ($rows);
}