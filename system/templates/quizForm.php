<!doctype html>
<html lang="ru" class="h-100">

<head>
  <?php Template::render('parts/meta') ?>
  <title>Редактор теста</title>
  <?php Template::render('parts/head') ?>
</head>

<body class="d-grid h-100" style="grid-template-rows: auto 1fr auto;">
  <?php Template::render('parts/header') ?>
  <main class="d-flex d-flex-column align-items-start">
    <div class="container my-4" id="quizArea" data-quiz-id="<?= $quiz['id'] ?>">
      <h1 class="h3 mb-4 text-center"><?= $quiz['id'] ? 'Редактирование теста' : 'Новый тест' ?></h1>
      <div class="col-lg-6 mb-4 mx-auto">
        <label class="mb-1">Название теста</label>
        <input type="text" class="form-control" id="title" value="<?= htmlspecialchars($quiz['title']) ?>">
      </div>
      <div class="col-lg-6 mb-5 mx-auto" id="questionArea">
      </div>
      <div class="d-grid col-lg-5 mb-3 mx-auto">
        <button id="nextQuestionButton" class="btn btn-lg btn-pink rounded-pill mb-3" onclick="nextQuestion()">Продолжить</button>
        <button id="saveQuizButton" class="btn btn-lg btn-pink rounded-pill mb-3" onclick="saveQuiz()" style="display: none;"><?= $quiz['id'] ? 'Сохранить тест' : 'Завершить создание теста' ?></button>
        <button id="addQuestionButton" class="btn btn-lg btn-pink rounded-pill mb-3" onclick="addQuestion()" style="display: none;">Добавить вопрос</button>
        <button id="delQuestionButton" class="btn btn-lg btn-pink rounded-pill mb-3" onclick="delQuestion()" style="display: none;">Удалить вопрос</button>
      </div>
    </div>
  </main>

  <script>
    const quiz = <?= $quiz['content'] ?? 'null' ?>;
  </script>
  <script src="/js/quizForm.js?<?= filemtime(Config::BASE_DIR . '/js/quizForm.js') ?>"></script>

  <?php Template::render('parts/footer') ?>
  <?php Template::render('parts/foot') ?>
</body>

</html>