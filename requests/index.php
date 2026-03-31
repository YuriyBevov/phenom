<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Запросы закупщиков");
?><? $APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    ".default",
    array(
      "CACHE_TIME" => "3600",
      "CACHE_TYPE" => "A",
      "CHAIN_ITEM_LINK" => "",
      "CHAIN_ITEM_TEXT" => "",
      "COMPONENT_TEMPLATE" => ".default",
      "EDIT_URL" => "",
      "IGNORE_CUSTOM_TEMPLATE" => "N",
      "LIST_URL" => "",
      "SEF_MODE" => "N",
      "SUCCESS_URL" => "/requests/success.php",
      "USE_EXTENDED_ERRORS" => "Y",
      "VARIABLE_ALIASES" => array("WEB_FORM_ID" => "WEB_FORM_ID", "RESULT_ID" => "RESULT_ID",),
      "WEB_FORM_ID" => "1"
    )
  ); ?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>