<?php
include ("path.php"); include 'app/controllers/topics.php'; $post = selectSingle('posts', 'users' ,$_GET['post'])  ?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
  <title> Новость </title>
</head>
<body>
<?php include ("app/include/header.php");?>
<!-- Главный блок -->
<div class = "container">
  <div class = "content row">
    <div class = "main-content col-md-9 col-12">
      <h2> <?php echo $post['title'];?> </h2>
      <div class="single_post row">
        <div class = "img col-12 ">
          <img src="<?= BASE_URL . 'IMAGE/posts/' . $post['img']?>" class="img-thumbnail">
        </div>
        <div class="info">
          <i class="far fa-user"> <?= $post['username']?></i>
          <i class="far fa-calendar"> <?= $post['created_date']?></i>
        </div>
        <div class="single_post_text col-12 ">
            <?= $post['content'];?>
      </div>
          <!-- Комментарии-->
          <?php include("app/include/comments.php"); ?>
    </div>
  </div>
      <!-- Sidebar -->
      <div class="sidebar col-md-3 col-12">
          <div class = "section search">
              <h3> Поиск </h3>
              <form action="/" method="post">
                  <input type="text" name="search-term" class = "text-input" placeholder = "Введите искомое значение">
              </form>
          </div>
          <div class ="section topics">
              <h3> Категории </h3>
              <ul>
                  <?php foreach ($topics as $key => $topic):; ?>
                      <li>
                          <a href = "<?= BASE_URL . 'category.php?post=' . $topic['id'];?> "> <?=$topic['name'];?> </a>
                      </li>
                  <?php endforeach; ?>
              </ul>
          </div>
      </div>
    </div>
</div>
<!-- Footer -->
<?php include ("app/include/footer.php");?>
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