<!doctype html>
<html lang="ru" class="h-100">

<head>
  <?php Template::render('parts/meta') ?>
  <title>Тест на определение прошлого и измены партнера</title>
  <?php Template::render('parts/head') ?>
</head>

<body class="d-grid h-100" style="grid-template-rows: auto 1fr auto;">
  <?php Template::render('parts/header') ?>
  <main class="d-flex d-flex-column align-items-center">
    <div class="container text-center my-5">
      <h1 class="h3 mb-5">Тест на определение прошлого и измены партнера</h1>
      <p class="col-lg-5 mx-auto mb-5">
        Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться.
        Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона,
        а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации
        "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..".
      </p>
      <div class="d-grid col-lg-5 mx-auto">
        <a href="/quiz" class="btn btn-lg btn-pink rounded-pill">Создать тест</a>
      </div>
    </div>
  </main>
  <?php Template::render('parts/footer') ?>
  <?php Template::render('parts/foot') ?>
</body>

</html>