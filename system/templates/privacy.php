<!doctype html>
<html lang="ru" class="h-100">

<head>
  <?php Template::render('parts/meta') ?>
  <title>Политика конфиденциальности</title>
  <?php Template::render('parts/head') ?>
</head>

<body class="d-grid h-100" style="grid-template-rows: auto 1fr auto;">
  <?php Template::render('parts/header') ?>
  <main class="d-flex d-flex-column align-items-start">
    <div class="container">
      <h1 class="h3 my-5 text-center">Политика конфиденциальности</h1>
      <div class="col-lg-8 mx-auto">
        <p>
          Многие программы электронной вёрстки
          и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам
          "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения.
        </p>
        <p>
          Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться.
          Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона,
          а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации
          "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.."
        </p>
      </div>
    </div>
  </main>
  <?php Template::render('parts/footer') ?>
  <?php Template::render('parts/foot') ?>
</body>

</html>