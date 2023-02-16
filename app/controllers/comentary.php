<?php
$page = $_GET['post'];
$email = '';
$comment = '';
$errMsg = [];
$status = 0;
$comments = [];



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])) {

    $email= trim($_POST['email']);
    $comment = trim($_POST['comment']);

    if ($email === '' || $comment === '') {
        $errMsg = 'Заполнены не все поля';
    }elseif (mb_strlen($comment,  'UTF8') > 50){
    array_push($errMsg, "Комментарийдолжен быть менее 50 символов");

    }else {
        $user = selectOne('users', ['email' => $email]);
        if($user['email'] == $email && $user ['admin'] == 1){
            $status = 1;
        }
        $comment = [
            'status' => $status,
            'page' => $page,
            'email' => $email,
            'comment' => $comment


        ];

        $comment = insert('comments', $comment);
        $comments = selectAll('comments', ['page' => $page, 'status' => 1]);

    }
} else {
    $email = '';
    $comment = '';
    $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
}
//Редакртирование
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]);


    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $topic = $post['id_topic'];


}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) {

    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $destination = ROOT_PATH . "\IMAGE\posts\\" . $imgName;

        $result = move_uploaded_file($fileTmpName, $destination);

        if ($result) {
            $_POST['img'] = $imgName;
        }
    }
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);

    if ($title === '' || $content === '') {
        $errMsg = 'Заполнены не все поля';
    } else {
        $post = [
            'id_user' => $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'id_topic' => $topic
        ];

        $post = update('posts', $id, $post);


    }
    //tt($post);
} else {
    $id = '';
    $title = '';
    $content = '';
    $topic = '';
}
//удаление
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    delete('posts', $id);
}

