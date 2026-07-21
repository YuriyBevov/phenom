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


  <header class="header" <?= ($USER->isAdmin() ? 'style="position:static !important;"' : '') ?>>
    <div class="container">

      <div class="header__row">

        <div class="header__row-col header__row-col--left">
          <a href="/contacts/" class="header__contact-link" aria-label="Контакты">
            <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
              <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-pin'></use>
            </svg>
          </a>
          <button class="main-btn header__callback-btn" data-form-id="1">
            Написать нам
          </button>
        </div>

        <div class="header__row-col header__row-col--middle">
          <? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/logo.php");  ?>
        </div>

        <div class="header__row-col header__row-col--right">
          <button class="search-title-opener main-btn">
            <svg style="fill:var(--white);" width='16' height='16' role='img' aria-hidden='true' focusable='false'>
              <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-search'></use>
            </svg>
          </button>

          <div class="header__contacts">
            <div class="header__contacts-row">
              <?
              $APPLICATION->IncludeFile(
                SITE_DIR . 'include/phone.php',
                array(),
                array('MODE' => 'html', 'NAME' => 'телефоны', 'SHOW_BORDER' => true)
              );
              ?>
            </div>
            <div class="header__contacts-row">
              <?
              $APPLICATION->IncludeFile(
                SITE_DIR . 'include/mail.php',
                array(),
                array('MODE' => 'html', 'NAME' => 'почту', 'SHOW_BORDER' => true)
              );
              ?>
            </div>
          </div>

          <button type="button" class="main-btn burger-btn burger-btn--opener" aria-label="Открыть меню">
            <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
              <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-burger'></use>
            </svg>
          </button>
        </div>
      </div>

      <div class="header__row">

        <div class="menu">
          <div class="menu__wrapper">
            <div class="menu__header">
              <? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/logo.php");  ?>
              <div class="burger-btn burger-btn--closer main-btn" aria-label="Кнопка закрытия меню">
                <svg width="20" height="20" viewBox="0 0 20 20" role="img" aria-hidden="true" focusable="false">
                  <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-cross"></use>
                </svg>
              </div>
            </div>
            <? $APPLICATION->IncludeComponent(
              "bitrix:menu",
              "top-menu",
              array(
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "2",
                "MENU_CACHE_GET_VARS" => array(),
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_THEME" => "site",
                "ROOT_MENU_TYPE" => "top",
                "USE_EXT" => "Y",
                "COMPONENT_TEMPLATE" => "top-menu"
              ),
              false
            ); ?>

            <div class="contacts-block">
              <?
              $APPLICATION->IncludeFile(
                SITE_DIR . 'include/phone.php',
                array(),
                array('MODE' => 'html', 'NAME' => 'номер телефона', 'SHOW_BORDER' => true)
              );
              ?>

              <?
              $APPLICATION->IncludeFile(
                SITE_DIR . 'include/mail.php',
                array(),
                array('MODE' => 'html', 'NAME' => 'адрес эл.почты', 'SHOW_BORDER' => true)
              );
              ?>

              <button class="main-btn header__callback-btn" data-form-id="1">
                Написать нам
              </button>
            </div>

            <? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/social.php");  ?>


          </div>
        </div>

        <!-- <button class="search-title-opener">
          <svg style="fill:var(--white);" width='16' height='16' role='img' aria-hidden='true' focusable='false'>
            <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-search'></use>
          </svg>
        </button> -->
      </div>

      <? $APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"search-title", 
	[
		"CATEGORY_0" => [
			0 => "iblock_site_content",
		],
		"CATEGORY_0_TITLE" => "Результаты поиска",
		"CATEGORY_0_iblock_site_content" => [
			0 => "11",
			1 => "14",
		],
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"COMPONENT_TEMPLATE" => "search-title"
	],
	false
); ?>

    </div>
  </header>

  <main id="workarea">
    <?
    $curPage = $APPLICATION->GetCurPage();
    $is404 = defined("ERROR_404") && ERROR_404 === "Y";

    if ($curPage != "/" && !$is404): ?>
      <? $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "lw-breadcrumb",
        [
          "PATH" => "",
          "SITE_ID" => "s1",
          "START_FROM" => "0",
          "COMPONENT_TEMPLATE" => "lw-breadcrumb"
        ],
        false
      ); ?>
    <? endif; ?>