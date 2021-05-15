<!doctype html>
<html lang="ru" class="h-100">

<head>
  <?php Template::render('parts/meta') ?>
  <title>Страница не найдена</title>
  <?php Template::render('parts/head') ?>
</head>

<body class="d-grid h-100">
  <main class="d-flex d-flex-column align-items-center">
    <div class="container text-center my-5">
      <h1 class="h3 mb-5"><?= $message ? htmlspecialchars($message) :  'Страница не найдена' ?></h1>
      <?php if (!$message) { ?>
      <p class="d-grid col-lg-5 mx-auto">
        <a href="/" class="btn btn-lg btn-pink rounded-pill">Перейти на главную</a>
      </p>
      <?php } ?>
    </div>
  </main>
  <?php Template::render('parts/foot') ?>
</body>

</html>