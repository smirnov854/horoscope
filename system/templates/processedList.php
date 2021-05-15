<!doctype html>
<html lang="ru" class="h-100">

<head>
  <?php Template::render('parts/meta') ?>
  <title>Пройденные тесты</title>
  <?php Template::render('parts/head') ?>
</head>

<body class="d-grid h-100" style="grid-template-rows: auto 1fr auto;">
  <?php Template::render('parts/header') ?>
  <main class="d-flex d-flex-column align-items-start">
    <div class="container my-4">
      <div class="col-sm-10 col-md-8 col-lg-5 mx-auto mb-5 text-center">
        <h1 class="h3">Пройденные тесты</h1>

        <h2 class="h4 mb-3 mt-4">Оплаченные</h2>
        <?php if (empty($quizes['paid'])) { ?>
          <div>Нет</div>
        <?php } else { ?>
          <?php foreach ($quizes['paid'] as $quiz) { ?>
            <div class="shadow pt-4 px-4 mb-4">
              <h5 class="mb-3"><?= htmlspecialchars($quiz['title']) ?></h5>
              <div class="text-start">
                <?php foreach ($quiz['content'] as $k => $item) { ?>
                  <div class="my-2">
                    <div class="fw-bold">
                      <?= htmlspecialchars(empty($item['question']) ? 'Вопрос №' . ($k + 1) : $item['question']) ?>
                    </div>
                    <div>Ответ: <?= htmlspecialchars($item['answer']) ?></div>
                  </div>
                  <?php if ($k > 1) break; ?>
                <?php } ?>
              </div>
              <div class="d-grid w-75 mx-auto py-4">
                <a class="btn btn-lg btn-pink rounded-pill mb-3" href="/quizes/<?= intval($quiz['id']) ?>">
                  Посмотреть полностью
                </a>
              </div>
            </div>
          <?php } ?>
        <?php } ?>

        <h2 class="h4 mb-3 mt-5">Неоплаченные</h2>
        <?php if (empty($quizes['notPaid'])) { ?>
          <div>Нет</div>
        <?php } else { ?>
          <?php foreach ($quizes['notPaid'] as $quiz) { ?>
            <div class="shadow pt-4 px-4 mb-4">
              <h5 class="mb-3"><?= htmlspecialchars($quiz['title']) ?></h5>
              <div class="text-start fade-gradient">
                <?php foreach ($quiz['content'] as $k => $item) { ?>
                  <div class="my-2">
                    <div class="fw-bold"><?= htmlspecialchars(empty($item['question']) ? 'Вопрос №' . ($k + 1) : $item['question']) ?></div>
                    <div>Ответ: <?= htmlspecialchars($item['answer']) ?></div>
                  </div>
                  <?php if ($k > 1) break; ?>
                <?php } ?>
              </div>
              <div class="d-grid w-75 mx-auto pb-4">
                <a class="btn btn-lg btn-pink rounded-pill mb-3" href="javascript:;">Оплатить и посмотреть</a>
                <a class="d-block" href="/privacy" target="_blank">Политика конфиденциальности</a>
              </div>
            </div>
          <?php } ?>
        <?php } ?>

      </div>
    </div>
  </main>
  <?php Template::render('parts/footer') ?>
  <?php Template::render('parts/foot') ?>
  <script src="/js/resetPassword.js?<?= filemtime(Config::BASE_DIR . '/js/resetPassword.js') ?>"></script>
</body>

</html>