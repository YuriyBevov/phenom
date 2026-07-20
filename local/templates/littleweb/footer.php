<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
</main>

<? $APPLICATION->IncludeComponent(
  "bitrix:form.result.new",
  "callback-form",
  array(
    "AJAX_MODE" => "Y",
    "AJAX_OPTION_JUMP" => "N",
    "AJAX_OPTION_STYLE" => "N",
    "AJAX_OPTION_HISTORY" => "N",
    "CACHE_TIME" => "3600",
    "CACHE_TYPE" => "A",
    "CHAIN_ITEM_LINK" => "",
    "CHAIN_ITEM_TEXT" => "",
    "EDIT_URL" => "",
    "IGNORE_CUSTOM_TEMPLATE" => "N",
    "LIST_URL" => "",
    "SEF_MODE" => "N",
    "SUCCESS_URL" => "",
    "USE_EXTENDED_ERRORS" => "Y",
    "WEB_FORM_ID" => "3",
    "COMPONENT_TEMPLATE" => "callback-form",
    "VARIABLE_ALIASES" => array(
      "WEB_FORM_ID" => "WEB_FORM_ID",
      "RESULT_ID" => "RESULT_ID",
    )
  ),
  false
); ?>

<div class="front-map">
  <?
  $APPLICATION->IncludeFile(
    SITE_DIR . 'include/map.php',
    array(),
    array('MODE' => 'html', 'NAME' => 'карту', 'SHOW_BORDER' => true)
  );
  ?>
</div>

<div class="fixed-contacts">
  <? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/social.php");  ?>
  <a href="/services/" class="main-btn">Наши услуги</a>
</div>


<footer class="footer">
  <div class="container">
    <div class="footer__row footer__row--top">
      <div class="footer__row-col">
        <? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/logo.php");  ?>
        <small><?= date("Y") ?> © RlabGroup</small>
        <a href="/policy/" class="policy-link"><small>Политика конфиденциальности</small></a>
      </div>
      <div class="footer__row-col">
        <span class="footer__row-col-title">Каталог</span>
        <ul class="bottom-menu">
          <li>
            <a href="/">Раздел каталога</a>
          </li>
          <li>
            <a href="/">Раздел каталога</a>
          </li>
          <li>
            <a href="/">Раздел каталога</a>
          </li>
        </ul>
      </div>
      <div class="footer__row-col">
        <span class="footer__row-col-title">Информация</span>
        <ul class="bottom-menu">
          <li>
            <a href="/">О компании</a>
          </li>
          <li>
            <a href="/">Статьи</a>
          </li>
          <li>
            <a href="/">Контакты</a>
          </li>
        </ul>
      </div>
      <div class="footer__row-col">
        <span class="footer__row-col-title">Контакты</span>
        <div class="footer__contacts-wrapper">
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
          ); ?>
        </div>
        <? include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/social.php"); ?>
      </div>
    </div>
    <div class="footer__row footer__row--bottom">
      <a href="mailto:yuriybevov@gmail.com" class="dev-link">
        <span>Сделано в</span>
        <img data-v-12762536="" src="<?= SITE_TEMPLATE_PATH ?>/_dist/images/littleweb-logo.svg" alt="Littleweb" class="footer-logo">
      </a>
    </div>
  </div>
</footer>



</body>

</html>