<?php
include 'path.php';
include 'app/controllers/topics.php';
$page = isset($_GET['page']) ? $_GET['page']: 1;
$limit = 4;
$offset = $limit * ($page - 1);
$total_pages = round(countRow('posts') /$limit, 0);
$posts = selectAllFromPostsWithUsersOnIndex('posts', 'users', $limit, $offset);
$topTopic = selectTopTopics('posts');
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

  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
  <title> Главная </title>
</head>
<body>
<?php include ("app/include/header.php");?>
<!-- Карусель !-->
<div class = "container">
  <div>
    <h2 class="slider-title" style = "text-align: center";> Топ </h2>
  </div>
  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" >
        <div class="carousel-inner" >
            <div class="carousel-inner" >
            <?php foreach ($topTopic as $key => $post1): ?>
                <?php if($key == 0):?>
            <div class="carousel-item active">
                <?php else: ?>
                <div class="carousel-item" >
                <?php endif; ?>
                        <img src="<?= BASE_URL . 'IMAGE/posts/' . $post1['img']?>" class="d-block w-100" alt="...">
                        <div class="carousel-caption-hack carousel-caption d-none d-md-block">
                            <h5><a href="<?= BASE_URL . 'single.php?post=' . $post1['id'];?>"> <?=substr($post1['title'], 0, 30)?></a></h5>
                        </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
     </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
<!-- Главный блок -->
<div class = "container">
  <div class = "content row">
    <div class = "main-content col-md-9 col-12">
      <h2> Последние публикации </h2>
        <?php foreach ($posts as $post): ?>
      <div class="post row">
        <div class = "img col-12 col-md-3">
          <img src="<?= BASE_URL . 'IMAGE/posts/' . $post['img']?>" alt="" class="img-thumbnail">
        </div>
        <div class="post_text col-12 col-md-8">
          <h3>
            <a href="<?= BASE_URL . 'single.php?post=' . $post['id'];?>"> <?=substr($post['title'], 0, 30)?></a>
          </h3>
          <i class="far fa-user"><?=($post['username'])?></i>
          <i class="far fa-calendar"> <?=($post['created_date'])?></i>
          <i class="preview-text"> <?=substr($post['content'], 0, 120  ) . '...'?> </i>
        </div>
      </div>
        <?php endforeach; ?>
        <!--Навигация -->
        <?php include ("app/include/plagination.php");?>
    </div>
    <!-- Sidebar -->
    <div class="sidebar col-md-3 col-12">
      <div class = "section search">
        <h3> Поиск </h3>
        <form action="search.php" method="post">
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