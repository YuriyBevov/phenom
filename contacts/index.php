<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>

<section class="section contacts">
  <div class="container">
    <div class="page-head">

      <h1 class="page-head-title">
        <? $APPLICATION->IncludeFile(
          SITE_DIR . 'include/contacts/title.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'заголовок', 'SHOW_BORDER' => true)
        ); ?>
      </h1>

      <p class="page-head-description">
        <? $APPLICATION->IncludeFile(
          SITE_DIR . 'include/contacts/description.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'описание', 'SHOW_BORDER' => true)
        ); ?>
      </p>

    </div>

    <?
    $APPLICATION->IncludeFile(
      SITE_DIR . 'include/phone.php',
      array(),
      array('MODE' => 'html', 'NAME' => 'телефоны', 'SHOW_BORDER' => true)
    );

    $APPLICATION->IncludeFile(
      SITE_DIR . 'include/mail.php',
      array(),
      array('MODE' => 'html', 'NAME' => 'почту', 'SHOW_BORDER' => true)
    );

    $APPLICATION->IncludeFile(
      SITE_DIR . 'include/address.php',
      array(),
      array('MODE' => 'html', 'NAME' => 'адрес', 'SHOW_BORDER' => true)
    );

    include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/social.php");
    ?>
  </div>
</section>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>