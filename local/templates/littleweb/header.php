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
  $curPage = $APPLICATION->GetCurPage();
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
          <?php
          if ($curPage != SITE_DIR . "index.php"):
            if (\Bitrix\Main\ModuleManager::isModuleInstalled('search')):
          ?>
              <? $APPLICATION->IncludeComponent(
                "bitrix:search.title",
                "kovry",
                [
                  "NUM_CATEGORIES" => "1",
                  "TOP_COUNT" => "5",
                  "CHECK_DATES" => "N",
                  "SHOW_OTHERS" => "N",
                  "PAGE" => SITE_DIR . "search/",
                  "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
                  "CATEGORY_0" => [
                    0 => "iblock_products",
                  ],
                  "CATEGORY_0_iblock_catalog" => [
                    0 => "all",
                  ],
                  "CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
                  "SHOW_INPUT" => "Y",
                  "INPUT_ID" => "title-search-input",
                  "CONTAINER_ID" => "search",
                  "PRICE_CODE" => [],
                  "SHOW_PREVIEW" => "Y",
                  "PREVIEW_WIDTH" => "75",
                  "PREVIEW_HEIGHT" => "75",
                  "CONVERT_CURRENCY" => "Y",
                  "COMPONENT_TEMPLATE" => "search-title",
                  "ORDER" => "date",
                  "USE_LANGUAGE_GUESS" => "Y",
                  "TEMPLATE_THEME" => "blue",
                  "PRICE_VAT_INCLUDE" => "Y",
                  "PREVIEW_TRUNCATE_LEN" => "",
                  "CATEGORY_0_iblock_products" => [
                    0 => "2",
                    1 => "3",
                    2 => "7",
                  ]
                ],
                false
              ); ?>
          <?php
            endif;
          endif;
          ?>

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
    <?

    if ($curPage != '/' && !defined("ERROR_404")) {
      $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "lw-breadcrumb",
        [
          "PATH" => "",
          "SITE_ID" => "s1",
          "START_FROM" => "0",
          "COMPONENT_TEMPLATE" => "lw-breadcrumb"
        ],
        false
      );
    }
    ?>