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
    <div class="container">
      <div class="header__row header__row--top">
        <div class="header__contact-block header__contact-block--left">
          <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
            <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/assets/sprite.svg#icon-pin'></use>
          </svg>
          <?
          $APPLICATION->IncludeFile(
            SITE_DIR . 'include/address.php',
            array(),
            array('MODE' => 'html', 'NAME' => 'адрес', 'SHOW_BORDER' => true)
          );
          ?>
        </div>
        <div class="header__contact-block">
          <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
            <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/assets/sprite.svg#icon-phone'></use>
          </svg>
          <?
          $APPLICATION->IncludeFile(
            SITE_DIR . 'include/phone.php',
            array(),
            array('MODE' => 'html', 'NAME' => 'телефоны', 'SHOW_BORDER' => true)
          );
          ?>
        </div>
        <div class="header__contact-block ">
          <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
            <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/assets/sprite.svg#icon-mail'></use>
          </svg>
          <?
          $APPLICATION->IncludeFile(
            SITE_DIR . 'include/mail.php',
            array(),
            array('MODE' => 'html', 'NAME' => 'почту', 'SHOW_BORDER' => true)
          );
          ?>
        </div>
      </div>

      <div class="header__row header__row--middle">
        <? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/logo.php");  ?>


        <a href="/catalog/" class="main-btn catalog-opener">
          Каталог
        </a>

        <? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/social.php");  ?>

        <button class="main-btn" data-form-id="1">
          Сделать заказ
        </button>

        <button type="button" class="main-btn burger-btn burger-btn--opener" aria-label="Открыть меню">
          <svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
            <use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-burger'></use>
          </svg>
        </button>
      </div>

      <div class="header__row header__row--bottom">
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
      </div>
  </header>

  <main id="workarea">
    <? if ($curPage != '/' && !defined("ERROR_404")) {
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
    } ?>