<?php
include SITE_ROOT . "/app/database/db.php";
$id ='';
$name = '';
$description = '';
$topics = selectAll('topics');
//Создание категории
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])){

    $admin = 0;
    $name= trim($_POST['name']);
    $description = trim($_POST['description']);
    if($name === '' || $description === '' ) {
        $errMsg = 'Заполнены не все поля';
    }else {
        $existence = selectOne('topics', ['name' => $name]);
        if($existence ['name'] === $name){
            $errMsg = "Категория уже существует";
        }else {
            $topic = [
                'name' => $name,
                'description' => $description
            ];
            $id = insert('topics', $topic);
            $topic = selectOne('topics', ['id' => $id] );
        }
    }
    //tt($post);
}else{
    $name = '';
    $description = '';
}
//Редакртирование
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $id = $_GET['id'];
    $topic = selectOne('topics',['id' => $id]);
    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])){

    $admin = 0;
    $name= trim($_POST['name']);
    $description = trim($_POST['description']);

    if($name === '' || $description === '' ) {
        $errMsg = 'Заполнены не все поля';
    }else {
            $topic = [
                'name' => $name,
                'description' => $description
            ];

            $id = $_POST['id'];
            //insert('topics', $topic);
            $topic_id = update('topics',$id, $topic);
    }
}
//удаление
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    delete('topics', $id);
}