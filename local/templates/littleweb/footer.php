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
  <a href="/catalog/" class="main-btn">Смотреть каталог</a>
</div>


<footer class="footer">
  <div class="container">
    site-footer
  </div>
</footer>

</body>

</html>