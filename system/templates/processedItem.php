<!doctype html>
<html lang="ru" class="h-100">

<head>
  <?php Template::render('parts/meta') ?>
  <title>Пройденный тест</title>
  <?php Template::render('parts/head') ?>
</head>

<body class="d-grid h-100" style="grid-template-rows: auto 1fr auto;">
  <?php Template::render('parts/header') ?>
  <main class="d-flex d-flex-column align-items-center">
    <div class="container my-4">
      <div class="col-sm-10 col-md-8 col-lg-5 mx-auto mb-5 text-center">
        <h1 class="h3 mb-4">Пройденный тест</h1>
        <div class="shadow p-4 mb-3">
          <h5 class="mb-3"><?= htmlspecialchars($quiz['title']) ?></h5>
          <div class="text-start">
            <?php foreach ($quiz['content'] as $k => $item) { ?>
              <div class="my-2">
                <div class="fw-bold">
                  <?= htmlspecialchars(empty($item['question']) ? 'Вопрос №' . ($k + 1) : $item['question']) ?>
                </div>
                <div>Ответ: <?= htmlspecialchars($item['answer']) ?></div>
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="d-grid w-75 mx-auto py-4">
          <a class="btn btn-lg btn-pink rounded-pill mb-3" href="/quizes">
            Посмотреть все
          </a>
        </div>
      </div>
    </div>
  </main>
  <?php Template::render('parts/footer') ?>
  <?php Template::render('parts/foot') ?>
  <script src="/js/resetPassword.js?<?= filemtime(Config::BASE_DIR . '/js/resetPassword.js') ?>"></script>
</body>

</html>