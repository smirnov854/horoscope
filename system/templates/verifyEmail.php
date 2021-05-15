<!doctype html>
<html lang="ru" class="h-100">

<head>
  <?php Template::render('parts/meta') ?>
  <title>Подтверждение email</title>
  <?php Template::render('parts/head') ?>
</head>

<body class="d-grid h-100" style="grid-template-rows: auto 1fr auto;">
  <?php Template::render('parts/header') ?>
  <main class="d-flex d-flex-column align-items-center">
    <div class="container text-center my-5">
      <h1 class="h3 mb-5">Активация профиля</h1>
      <p class="col-lg-5 mx-auto">
        <?php if ($error) { ?>
          <div class="text-danger">Неверный email или код активации.</div>
        <?php } else { ?>
          Профиль активирован. Вход <a href="/">здесь</a>.
        <?php } ?>
      </p>
    </div>
  </main>
  <?php Template::render('parts/footer') ?>
  <?php Template::render('parts/foot') ?>
</body>

</html>