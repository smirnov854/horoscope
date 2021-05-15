<!doctype html>
<html lang="ru" class="h-100">

<head>
  <?php Template::render('parts/meta') ?>
  <title>Тарифы</title>
  <?php Template::render('parts/head') ?>
</head>

<body class="d-grid h-100" style="grid-template-rows: auto 1fr auto;">
  <?php Template::render('parts/header') ?>
  <main class="d-flex d-flex-column align-items-start">
    <div class="container mb-5">
      <h1 class="h3 my-4 text-center">Тарифы</h1>
      <div class="row">
        <?php foreach ($tariffs as $tariff) { ?>
          <div class="col-lg-4 mb-3">
            <div class="card h-100 shadow">
              <div class="card-body d-grid" style="grid-template-rows: auto auto auto 1fr;">
                <h4 class="card-title mb-3"><?= htmlspecialchars($tariff['info']['title']) ?></h4>
                <h3 class="card-subtitle mb-3 text-pink">
                  <?= htmlspecialchars($tariff['info']['heading']) ?>
                </h3>
                <p class="card-text small">
                  <?= htmlspecialchars($tariff['info']['description']) ?>
                </p>
                <ul class="lh-sm">
                  <?php foreach ($tariff['info']['features'] as $feature) { ?>
                    <li class="my-2">
                      <?= htmlspecialchars($feature) ?>
                    </li>
                  <?php } ?>
                </ul>
                <div class="d-grid mt-5">
                  <a href="/order/<?= intval($tariff['id']) ?>" class="btn btn-lg btn-pink rounded-pill">Заказать</a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </main>
  <?php Template::render('parts/footer') ?>
  <?php Template::render('parts/foot') ?>
</body>

</html>