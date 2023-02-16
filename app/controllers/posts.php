<?php

include SITE_ROOT . "/app/database/db.php";
$id ='';
$title = '';
$content = '';
$img ='';
$topic = '';
$topics = selectAll('topics');
$posts = selectAll('posts');
$postAdm = selectAllFromPostsWithUsers('posts','users');
//Создание записи
//tt($postAdm);
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])){

    if(!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $destination = ROOT_PATH . "\IMAGE\posts\\" . $imgName;

        $result = move_uploaded_file($fileTmpName, $destination);

        if($result){
            $_POST['img'] = $imgName;
        }
    }

    $title= trim($_POST['title']);
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);

    if($title === '' || $content === '' ) {
        $errMsg = 'Заполнены не все поля';
    }else {
            $post = [
                'id_user' => $_SESSION['id'],
                'title' => $title,
                'content' => $content,
                'img' => $_POST['img'],
                'id_topic' => $topic

            ];

            $post = insert('posts', $post);
            $post = selectOne('posts', ['id' => $id] );

    }
    //tt($post);
}else{
    $id = '';
    $title = '';
    $content = '';
    $topic = '';
}
//Редакртирование
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $post = selectOne('posts',['id' => $_GET['id']]);


    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $topic = $post['id_topic'];


}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])){

    if(!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $destination = ROOT_PATH . "\IMAGE\posts\\" . $imgName;

        $result = move_uploaded_file($fileTmpName, $destination);

        if($result){
            $_POST['img'] = $imgName;
        }
    }
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);

    if($title === '' || $content === '' ) {
        $errMsg = 'Заполнены не все поля';
    }else {
        $post = [
            'id_user' => $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'id_topic' => $topic
        ];

        $post = update('posts',$id , $post);


    }
    //tt($post);
}else{
    $id = '';
    $title = '';
    $content = '';
    $topic = '';
}
//удаление
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    delete('posts', $id);
}
