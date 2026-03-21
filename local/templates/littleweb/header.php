<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <link rel="shortcut icon" type="image/x-icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.ico" />

  <? $APPLICATION->ShowHead(); ?>
  <title><? $APPLICATION->ShowTitle() ?></title>

  <?
  includeGlobalAssets();
  initBitrixCore('popup');
  ?>
</head>

<body>
  <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
  <header class="header">

    <div class="header__row header__row--top">
      <div class="container">
        <div class="region-block">
          <svg width='16' height='16' role='img' aria-hidden='true' focusable='false'>
            <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-pin'></use>
          </svg>
          <span>Москва</span>
        </div>

        <!-- comp -->
        <div class="row-menu">
          <ul>
            <li>
              <a href="#">Стать участником платформы</a>
            </li>
            <li>
              <a href="#">Мобильное приложение</a>
            </li>
            <li>
              <a href="#">Помощь</a>
            </li>
            <li>
              <a href="#">Тарифы</a>
            </li>
          </ul>
        </div>

        <div class="currency-label">
          RUB
        </div>

        <div class="lang-switcher">
          <a href="/" class="active">RU</a>
          <a href="/">en</a>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="header__row header__row--main">
        <a href="/">
          <img src="<?= SITE_TEMPLATE_PATH . '/_dist/images/logo.svg' ?>" alt="">
        </a>

        <div class="header__search-block">
          <button class="main-btn">
            <svg width='16' height='16' role='img' aria-hidden='true' focusable='false'>
              <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-burger'></use>
            </svg>
            <span>Каталог</span>
          </button>
          <div class="search-title">
            <label class="main-input-wrapper">
              <input type="text" class="main-input" placeholder="Поиск">
            </label>
            <button aria-label="Поиск">
              <svg width='16' height='16' role='img' aria-hidden='true' focusable='false'>
                <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-search'></use>
              </svg>
            </button>
          </div>
        </div>

        <div class="header__btn-group">
          <a href="#" class="iconed-btn">
            <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
              <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-bag'></use>
            </svg>
            <span>Контракты</span>
          </a>
          <a href="#" class="iconed-btn">
            <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
              <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-list'></use>
            </svg>
            <span>Заявки</span>
          </a>
          <a href="#" class="iconed-btn">
            <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
              <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-chat'></use>
            </svg>
            <span>Чат</span>
          </a>
          <a href="#" class="iconed-btn">
            <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
              <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-personal'></use>
            </svg>
            <span>Мой магазин</span>
          </a>
          <a href="#" class="iconed-btn">
            <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
              <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-compare'></use>
            </svg>
            <span>Сравнить</span>
          </a>
          <a href="#" class="iconed-btn">
            <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
              <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-heart'></use>
            </svg>
            <span>Избранное</span>
          </a>
        </div>

        <div class="company-owner-block">
          <div class="company-owner-block__img-wrapper">
            <img src="" alt="company-name" width="40" height="40">
          </div>
          <div class="company-owner-block__content">
            <small>Директор</small>
            <span>Константинов И.И.</span>
          </div>
        </div>
      </div>
      <div class="header__row"></div>
    </div>
    </div>
  </header>
  <main id="workarea">