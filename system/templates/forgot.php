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
      <div class="col-sm-10 col-md-8 col-lg-4 mx-auto">
        <h1 class="h3 text-center text-uppercase mb-4">Восстановление доступа</h1>
        <form onsubmit="sendLink(this); return !1">
          <div id="error"class="text-center text-danger"></div>
          <div class="form-floating mb-3 mt-4">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            <label for="email">Email, указанный при регистрации</label>
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-lg btn-pink rounded-pill">Восстановить доступ</button>
          </div>
          <hr class="mt-4">
          <p class="text-center">Вспомнили пароль? Войти</p>
          <div class="d-grid">
            <a href="/login" class="btn btn-lg btn-pink rounded-pill">Войти</a>
          </div>
        </form>
      </div>
    </div>
  </main>
  <?php Template::render('parts/footer') ?>
  <?php Template::render('parts/foot') ?>
  <script src="/js/forgot.js?<?= filemtime(Config::BASE_DIR . '/js/forgot.js') ?>"></script>
</body>

</html>