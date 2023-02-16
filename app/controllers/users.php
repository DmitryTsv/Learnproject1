<?php
include SITE_ROOT . "/app/database/db.php";


$errMsg ='';
$users = selectAll('users');

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){
    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['mail']);
    $pass1 = trim($_POST['password1']);
    $pass2 = trim($_POST['password2']);

    if($login === '' || $email === '' || $pass1 === '') {
        $errMsg = 'Заполнены не все поля';
    }elseif ($pass1 !== $pass2){
        $errMsg = "Пароли должны быть одинаковыми";
    }else {
        $existence = selectOne('users', ['email' => $email]);
        if($existence ['email'] === $email){
            $errMsg = "Пользователь с такой почтой уже существует";
        }else {
            $pass = password_hash($pass1, PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $post);
            $user = selectOne('users', ['id' => $id] );
            //tt($user);
            //exit();
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['username'];
            $_SESSION['admin'] = $user['admin'];
            if($_SESSION['admin'])
            {
                header('location: ' . BASE_URL ."index.php" );
            }else{
                header('location:' . BASE_URL);
            }

            //tt($_SESSION);
            //exit();

            //$errMsg = "Пользователь $login зарегистрирован!";
        }
    }
            //tt($post);
}else{
    $login = '';
    $email = '';
}
    //id =  insert('users', $post);
//$isSubmit = true;
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])){
    $email = trim($_POST['mail']);
    $pass = trim($_POST['password']);
    if($email === '' || $pass === '') {
        $errMsg = 'Заполнены не все поля';
    }else{
        $existence = selectOne('users', ['email' => $email]);
        if($existence && password_verify($pass, $existence['password'])){
            $_SESSION['id'] = $existence['id'];
            $_SESSION['login'] = $existence['username'];
            $_SESSION['admin'] = $existence['admin'];

            if($_SESSION['admin'])
            {
                header('location: ' . BASE_URL . "app/posts/index.php");
            }else{
                header('location:' . BASE_URL);
            }

        }else{
            $errMsg = 'Почта или пароль введены не верно';
        }
    }
}else{

    $email = '';
}
//Добавление пользоваетля через админ-панель
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])){

    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['mail']);
    $pass1 = trim($_POST['password1']);
    $pass2 = trim($_POST['password2']);

    if($login === '' || $email === '' || $pass1 === '') {
        $errMsg = 'Заполнены не все поля';
    }elseif ($pass1 !== $pass2){
        $errMsg = "Пароли должны быть одинаковыми";
    }else {
        $existence = selectOne('users', ['email' => $email]);
        if($existence ['email'] === $email){
            $errMsg = "Пользователь с такой почтой уже существует";
        }else {
            $pass = password_hash($pass1, PASSWORD_DEFAULT);
            if(isset($_POST['admin'])) $admin = 1;
            $user= [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $user);
            $user = selectOne('users', ['id' => $id] );
            //tt($user);
            //exit();
            //tt($_SESSION);
            //exit();

            //$errMsg = "Пользователь $login зарегистрирован!";
        }
    }
    //tt($post);
}else{
    $login = '';
    $email = '';
}
//Редактирование
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])){
    $user = selectOne('users',['id' => $_GET['edit_id']]);

    $id = $user['id'];
    $username = $user['username'];
    $email = $user['email'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])){

    $admin = isset($_POST['admin']) ? 1 : 0;
    $id = $_POST['id'];
    $login = trim($_POST['login']);
    $email = trim($_POST['mail']);
    $pass1 = trim($_POST['password']);
    if($login === '' || $email === '' || $pass1 === '' ) {
        $errMsg = 'Заполнены не все поля';

    }else {
        $pass = password_hash($pass1, PASSWORD_DEFAULT);
        if(isset($_POST['admin'])) $admin = 1;
        $user = [
            'username' => $login,
            'email' => $email,
            'password' => $pass,
            'admin' => $admin
        ];
        $user = update('users',$id , $user);
    }
    //tt($post);
}
//удаление
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    delete('users', $id);
    header('location: ' . BASE_URL . 'app/users/index.php');
}
