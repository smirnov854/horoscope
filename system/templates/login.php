<!doctype html>
<html lang="ru" class="h-100">

<head>
  <?php Template::render('parts/meta') ?>
  <title>Вход</title>
  <?php Template::render('parts/head') ?>
</head>

<body class="d-grid h-100" style="grid-template-rows: auto 1fr auto;">
  <?php Template::render('parts/header') ?>
  <main class="d-flex d-flex-column align-items-center">
    <div class="container my-4">
      <div class="col-lg-4 mx-auto">
        <form action="/login" method="post">
          <h1 class="h2 text-center text-uppercase mb-4">Вход</h1>
          <?php if ($failure) { ?>
            <div class="text-center text-danger mb-4">Неверный email или пароль</div>
          <?php } ?>
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            <label for="email">Email</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
            <label for="password">Пароль</label>
          </div>
          <div class="d-grid my-3 text-center">
            <a href="/forgot">Забыл пароль?</a>
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-lg btn-pink rounded-pill">Войти</button>
          </div>
          <hr class="mt-4">
          <p class="text-center">Нет профиля? Зарегистрируйся</p>
          <div class="d-grid">
            <a href="/register" class="btn btn-lg btn-pink rounded-pill">Зарегистрироваться</a>
          </div>
        </form>
      </div>
    </div>
  </main>
  <?php Template::render('parts/footer') ?>
  <?php Template::render('parts/foot') ?>
</body>

</html>