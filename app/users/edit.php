<?php include '../../path.php'; include "../controllers/users.php"; ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../../css/admin.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <title> Главная </title>
</head>
<body>
<?php include ("../include/header-admin.php");?>
<!-- Карусель !-->
<div class="container">
    <?php include ("../include/sidebar-admin.php"); ?>
    <div class="posts col-9">
        <div class="button row">
            <a href="<?php echo  BASE_URL ."app/users/create.php";?>" class="col-3 btn btn-success">Создать</a>
            <a href="<?php echo  BASE_URL ."app/users/index.php";?>" class="col-3 btn btn-warning">Изменить</a>
        </div>
        <div class="row title-table">
            <h2>Изменение пользователя</h2>
        </div>
        <div class="row add-post">
            <form action="create.php" method="post">
                <input name="id" value="<?= $id;?>" type="hidden">
                <div class="mb-3 col-12 col-md-4">
                    <label for="formGroupExampleInput" class="form-label"> Логин</label>
                    <input name = "login" value="<?=$login?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите логин">
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4">
                    <label for="exampleInputEmail1" class="form-label">Почта</label>
                    <input name ="mail" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4">
                    <label for="exampleInputPassword1" class="form-label">Пароль</label>
                    <input name="password"  type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="w-100"></div>
                <input name="admin" class="form-check-input" type="checkbox" value="1" id = "flexChekChecked" checked>
                <label class="form-chek-label" for="flexChekChecked">
                    Admin
                </label>
                <div class="col-12">
                    <button name="update-user" class="btn btn-primary" type="submit">Сохранить запись</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Footer -->
<?php include ("../include/footer.php");?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>

?>