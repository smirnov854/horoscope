<!doctype html>
<html lang="ru" class="h-100">

<head>
  <?php Template::render('parts/meta') ?>
  <title>Анонимный тест</title>
  <?php Template::render('parts/head') ?>
</head>

<body class="d-grid h-100" style="grid-template-rows: 1fr;">
  <main class="d-flex d-flex-column align-items-center">
    <div class="container col-11 col-sm-8 col-lg-6 mx-auto my-4 py-4" id="quizArea">
      <h1 class="h3 mb-4 mt-3 text-center">Анонимный тест</h1>
      <div class="text-center">
        <div id="questionArea">
          <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
        </div>
        <div id="errorArea" class="text-danger">
        </div>
        <div id="answersArea" class="text-start d-inline-block">
        </div>
      </div>
      <div class="d-grid col-10 mx-auto">
        <button id="nextButton" class="btn btn-lg btn-pink rounded-pill mb-3" onclick="nextQuestion()">Начать</button>
        <button id="resultButton" class="btn btn-lg btn-pink rounded-pill mb-4" onclick="showResult()" style="display: none;">Просмотреть</button>
      </div>
    </div>
  </main>

  <script>
    const quiz = <?= $quiz['content'] ?? 'null' ?>;
  </script>
  <script src="/js/quizProcess.js?<?= filemtime(Config::BASE_DIR . '/js/quizProcess.js') ?>"></script>

  <?php Template::render('parts/foot') ?>
</body>

</html>