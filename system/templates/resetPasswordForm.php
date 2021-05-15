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
        <form onsubmit="resetPassword(this); return !1">
          <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
          <input type="hidden" name="code" value="<?= htmlspecialchars($code) ?>">
          <div id="error"class="text-center text-danger"></div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Новый пароль" required>
            <label for="password">Новый пароль</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password2" name="password2" placeholder="Повторите новый пароль" required>
            <label for="password2">Повторите новый пароль</label>
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-lg btn-pink rounded-pill">Установить пароль</button>
          </div>
        </form>
      </div>
    </div>
  </main>
  <?php Template::render('parts/footer') ?>
  <?php Template::render('parts/foot') ?>
  <script src="/js/resetPassword.js?<?= filemtime(Config::BASE_DIR . '/js/resetPassword.js') ?>"></script>
</body>

</html>