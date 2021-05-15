<!doctype html>
<html lang="ru" class="h-100">

<head>
  <?php Template::render('parts/meta') ?>
  <title>Шаблон теста</title>
  <?php Template::render('parts/head') ?>
</head>

<body class="d-grid h-100" style="grid-template-rows: auto 1fr auto;">
  <?php Template::render('parts/header') ?>
  <main class="d-flex d-flex-column align-items-start">
    <div class="container my-4">
      <h1 class="h3 mb-4 text-center">Шаблон теста</h1>
      <div class="col-lg-6 mb-4 mx-auto">
        <ol id="questionList">
          <?php /*
          <li class="question">
            <input type="text" disabled class="form-control my-2 question-input" value="Пол">
            <input type="hidden" class="answer-input" value="Мужской">
            <input type="hidden" class="answer-input" value="Женский">
          </li>
          <li class="question">
            <input type="text" disabled class="form-control my-2 question-input" value="Знак зодиака">
            <input type="hidden" class="answer-input" value="Овен">
            <input type="hidden" class="answer-input" value="Телец">
            <input type="hidden" class="answer-input" value="Близнецы">
            <input type="hidden" class="answer-input" value="Рак">
            <input type="hidden" class="answer-input" value="Лев">
            <input type="hidden" class="answer-input" value="Дева">
            <input type="hidden" class="answer-input" value="Весы">
            <input type="hidden" class="answer-input" value="Скорпион">
            <input type="hidden" class="answer-input" value="Стрелец">
            <input type="hidden" class="answer-input" value="Козерог">
            <input type="hidden" class="answer-input" value="Водолей">
            <input type="hidden" class="answer-input" value="Рыбы">
          </li>
          */ ?>
        </ol>
        <template id="questionTemplate">
          <li class="question">
            <div class="input-group my-2">
              <?php if ($isBaseTemplate) { ?>
                <div class="input-group-text">
                  <input class="form-check-input mt-0 question-immutable" type="checkbox" value="1" title="Неизменяемый">
                </div>
              <?php } ?>
              <input type="text" class="form-control question-input" placeholder="Вопрос">
              <button type="button" class="btn btn-success" onclick="addQuestion(this)">&plus;</button>
              <button type="button" class="btn btn-danger" onclick="removeQuestion(this)">&times;</button>
            </div>
            <ol class="answer-list">
            </ol>
          </li>
        </template>
        <template id="answerTemplate">
          <li class="answer">
            <div class="input-group my-2">
              <input type="text" class="form-control answer-input" placeholder="Ответ">
              <button type="button" class="btn btn-success" onclick="addAnswer(this)">&plus;</button>
              <button type="button" class="btn btn-danger" onclick="removeAnswer(this)">&times;</button>
            </div>
          </li>
        </template>
      </div>
      <div class="d-grid col-lg-5 mb-3 mx-auto">
        <button class="btn btn-lg btn-pink rounded-pill" onclick="saveTemplate()">Сохранить шаблон</button>
      </div>
      <div class="d-grid col-lg-5 mb-3 mx-auto">
        <a href="/quiz" class="btn btn-lg btn-pink rounded-pill">Создать тест</a>
      </div>
    </div>
  </main>

  <script>
    const data = <?= $data ?>;
    const isBaseTemplate = <?= $isBaseTemplate ? 'true' : 'false' ?>;
  </script>
  <script src="/js/quizTemplate.js?<?= filemtime(Config::BASE_DIR . '/js/quizTemplate.js') ?>"></script>

  <?php Template::render('parts/footer') ?>
  <?php Template::render('parts/foot') ?>
</body>

</html>