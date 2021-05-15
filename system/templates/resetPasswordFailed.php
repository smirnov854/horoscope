<!doctype html>
<html lang="ru" class="h-100">

<head>
  <?php Template::render('parts/meta') ?>
  <title>Восстановление доступа</title>
  <?php Template::render('parts/head') ?>
</head>

<body class="d-grid h-100" style="grid-template-rows: auto 1fr auto;">
  <?php Template::render('parts/header') ?>
  <main class="d-flex d-flex-column align-items-center">
    <div class="container my-4">
      <div class="col-sm-10 col-md-8 col-lg-4 mx-auto text-center">
        <h1 class="h3 mb-4 text-uppercase">Восстановление доступа</h1>
        <div class="text-danger mb-4">Ссылка для восстановления доступа недействительна или устарела.</div>
        <div class="d-grid">
          <a href="/forgot" class="btn btn-lg btn-pink rounded-pill">Запросить новую ссылку</a>
        </div>
      </div>
    </div>
  </main>
  <?php Template::render('parts/footer') ?>
  <?php Template::render('parts/foot') ?>
</body>

</html>