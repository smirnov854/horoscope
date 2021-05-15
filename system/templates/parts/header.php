<header class="navbar flex-nowrap lh-sm navbar-pink">
  <div class="container">
    <a class="navbar-brand text-wrap text-white text-center lh-1 mx-auto" href="/">
      Сервис определения прошлого и измены партнера
    </a>
    <?php if (in_array(Auth::user()['role'] ?? '', ['user', 'admin'])) { ?>
      <div class="navbar-item dropdown">
        <a class="dropdown-toggle text-white text-decoration-none" href="#" role="button" data-bs-toggle="dropdown">
          <div class="avatar d-inline-block" style="background-image: url(/img/avatar.jpeg)"></div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow">
          <li><a class="dropdown-item" href="/">Главная</a></li>
          <li class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="/template">Шаблон теста</a></li>
          <li class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="/history">Пройденные тесты</a></li>
          <li class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="/tariff">Оплата тарифов</a></li>
          <li class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="/terms">Условия сервиса</a></li>
          <?php if (Auth::user()['role'] == 'admin') { ?>
            <li class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/base-template">Общий шаблон</a></li>
          <?php } ?>
        </ul>
      </div>
    <?php } ?>
  </div>
</header>