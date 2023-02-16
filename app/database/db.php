<?php
session_start();
require 'connect.php';

function tt($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}
/* Проверка выполнения и хранение массива */
function dbCheckError($query){
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }
    return true;
}
/* Получение данных*/
function selectAll($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";
    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if(!is_numeric($value)){
                $value = "'".$value."'";
            }
            if($i === 0){
                $sql = $sql ." WHERE $key=$value";
            }else{
                $sql = $sql ." AND $key=$value";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
//Запрос на получение с одной таблицы
function selectOne($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if(!is_numeric($value)){
                $value = "'".$value."'";
            }
            if($i === 0){
                $sql = $sql ." WHERE $key=$value";
            }else{
                $sql = $sql ." AND $key=$value";
            }
            $i++;
        }
    }
    $sql = $sql. " LIMIT 1";
    //tt($sql);
    //exit();
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}
//Запись в таблицу Бд
function insert ($table, $params){
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value){
        if($i === 0){
           $coll = $coll . "$key";
           $mask = $mask . "'" ."$value" . "'";
        }else{
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }
    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
    //tt($sql);
    //exit();
    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbCheckError($query);
    return $pdo->lastInsertId();
}

function update ($table, $id ,$params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value){
        if($i === 0){

            $str =$str . $key . " = '" ."$value" . "'";
        }else{
            $str =$str .", " . $key . "= '" . $value . "'";
        }
        $i++;
    }
    $sql = "UPDATE $table SET $str WHERE id = $id";
    //tt($sql);
    //exit();
    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbCheckError($query);
}
function delete($table, $id){
    global $pdo;
    $sql = "DELETE FROM $table WHERE id =". $id;
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}
//delete('users', 8);

function selectAllFromPostsWithUsers ($table1, $table2){
    global $pdo;
    $sql = "SELECT
    t1.id,
    t1.title,
    t1.img,
    t1.content,
    t1.id_topic,
    t2.username
    FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
//выборка авторов постов
function selectAllFromPostsWithUsersOnIndex ($table1, $table2 ,$limit , $offset ){
    global $pdo;
    $sql = "SELECT p.*, u.username  FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id ORDER BY id DESC  LIMIT $limit OFFSET $offset  ";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
function selectTopTopics ($table1){
    global $pdo;
    $sql = "SELECT * FROM $table1 WHERE id_topic = 5";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
//Поиск по загаловкам и содержимому
function selectSearch  ($text, $table1, $table2){
    $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
    global $pdo;
    $sql = "SELECT 
    p.*, u.username 
    FROM $table1 AS p 
    JOIN $table2 AS u 
    ON p.id_user = u.id
    WHERE p.title LIKE '%$text%' OR p.content LIKE '%$text%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
//Выбор записи
function selectSingle  ( $table1, $table2, $id){
    global $pdo;
    $sql = "SELECT 
    p.*, u.username 
    FROM $table1 AS p 
    JOIN $table2 AS u 
    ON p.id_user = u.id
    WHERE p.id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}
//Колисетво строк таблицы
function countRow  ($table){
    global $pdo;
    $sql = "SELECT COUNT(*) FROM $table";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchColumn();
}