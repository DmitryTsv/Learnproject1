<?php
include SITE_ROOT . "/app/controllers/comentary.php";
?>
<div class="col-md-12 col-12 comments ">
    <h3>Оставить комментарий</h3>
    <form action="<?php BASE_URL . "single.php?post=$page"?>" method="post">
        <input name="page" type="hidden" value="<?=$page ?>">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email адрес</label>
            <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Оставить комментарий</label>
            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <?php if($_SESSION['id'] > 0): ?>
        <div class="col-12">
            <button type="submit" name="goComment" class="btn btn-primary">Отправить</button>
        </div>
        <?php endif; ?>
    </form>
    <?php if(count($comments) > 0): ?>
    <div class="roe all-comments">
        <h3 class="col-12">Комментарии</h3>
        <?php foreach ($comments as $comment): ?>
        <div class="one-comment col-12">
            <span><i class="far fa-envelope"></i><?= $comment['email']?></span>
            <span><i class="far fa-calendar-check"></i><?= $comment['created_date']?></span>
                <div class="col-12 text">
                    <?= $comment['comment']?>
                </div>


        </div>
        <?php endforeach; ?>

    </div>
    <?php endif; ?>
</div>
