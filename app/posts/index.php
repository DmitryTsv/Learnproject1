<?php include '../../path.php';
//include '../database/db.php';
include "../controllers/posts.php";

?>
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
                <a href="<?php echo  BASE_URL ."app/posts/create.php";?>" class="col-3 btn btn-success">Создать</a>
                <a href="<?php echo  BASE_URL ."app/posts/index.php";?>" class="col-3 btn btn-warning">Изменить</a>
            </div>
            <div class="row title-table">
                <div class="id col-1">ID</div>
                <div class="title col-3">Название</div>
                <div class="author col-2">Автор</div>
                <div class="red col-2">Редактировать</div>
                <div class="del col-2">Удалить</div>

            </div>
            <?php foreach ($postAdm as $key => $post):; ?>
            <div class="row title-table">

                <div class="id col-1"><?=$post['id'];?></div>
                <div class="title col-3"><?=$post['title'];?></div>
                <div class="author col-2"><?=$post['username'];?></div>
                <div class="red col-2"><a href="edit.php?id=<?=$post['id'];?>">Редактировать</a></div>
                <div class="del col-2"><a href="edit.php?del_id=<?=$post['id'];?>">Удалить</a></div>
            </div>
            <?php endforeach; ?>


        </div>
    </div>
</div>

<!-- Footer -->
<?php include ("../include/footer.php");?>










<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>
