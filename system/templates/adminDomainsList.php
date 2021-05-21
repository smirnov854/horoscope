<!doctype html>
<html lang="ru" class="h-100">

<head>
    <?php Template::render('parts/meta') ?>
    <title>Шаблон теста</title>
    <?php Template::render('parts/head') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="d-grid h-100" style="grid-template-rows: auto 1fr auto;">
<?php Template::render('parts/header') ?>
<main class="d-flex d-flex-column align-items-start">
    <div class="container my-4">
        <h1 class="h3 mb-4 text-center">Домены для генерации ссылок</h1>
        <?php foreach ($data as $row): ?>
            <div class="row col-lg-4">
                <div class="domain_select alert <?= !empty($row['on']) ? "alert-success" : "alert-danger" ?> " data-id="<?=$row['id']?>"><?= $row['domain'] ?></div>
            </div>
        <? endforeach; ?>

</main>
<?php Template::render('parts/footer') ?>
<?php Template::render('parts/foot') ?>
<script>
    $(".domain_select").on("click",function(){
        var id = $(this).attr("data-id")
        $.post("/admin-domains",{id : id},function(result){
            location.reload();
        },"json")
    })
</script>
</body>


</html>