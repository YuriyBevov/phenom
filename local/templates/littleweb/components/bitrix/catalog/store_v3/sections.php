<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

?>
<?
$filterName = !empty($arParams["FILTER_NAME"]) ? $arParams["FILTER_NAME"] : "arrFilter";
if (!isset($GLOBALS[$filterName]) || !is_array($GLOBALS[$filterName]))
{
	$GLOBALS[$filterName] = [];
}
?>

<? // Умный фильтр
?>
<? $APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter",
	"bootstrap_v4",
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SHOW_ALL_WO_SECTION" => "Y",
		"FILTER_NAME" => $filterName, // Имя переменной фильтра
		"PRICE_CODE" => $arParams["~PRICE_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SAVE_IN_SESSION" => "N",
		"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
		"XML_EXPORT" => "N",
		"SECTION_TITLE" => "NAME",
		"SECTION_DESCRIPTION" => "DESCRIPTION",
		'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
		"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		"SEF_MODE" => $arParams["SEF_MODE"],
		"SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
		"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
	),
	$component,
	array('HIDE_ICONS' => 'Y')
); ?>

<? // Список всех товаров
?>
<? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"store_v3",
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FILTER_NAME" => $filterName, // ВАЖНО! Тот же самый фильтр
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SHOW_ALL_WO_SECTION" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",

		// Сортировка
		"ELEMENT_SORT_FIELD" => !empty($arParams["TOP_ELEMENT_SORT_FIELD"]) ? $arParams["TOP_ELEMENT_SORT_FIELD"] : $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => !empty($arParams["TOP_ELEMENT_SORT_ORDER"]) ? $arParams["TOP_ELEMENT_SORT_ORDER"] : $arParams["ELEMENT_SORT_ORDER"],
		"ELEMENT_SORT_FIELD2" => $arParams["TOP_ELEMENT_SORT_FIELD2"] ?? "",
		"ELEMENT_SORT_ORDER2" => $arParams["TOP_ELEMENT_SORT_ORDER2"] ?? "",

		// Пагинация
		"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"AJAX_MODE" => "N",
		"DEFERRED_LOAD" => "N",
		"LAZY_LOAD" => "N",
		"LOAD_ON_SCROLL" => "N",
		"CYCLIC_LOADING" => "N",
		"SHOW_SECTIONS" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "Y",

		// Остальные параметры (скопируйте из вашего существующего кода)
		"SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"PRICE_CODE" => $arParams["~PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
		"CURRENCY_ID" => $arParams['CURRENCY_ID'],
		"HIDE_NOT_AVAILABLE" => $arParams['HIDE_NOT_AVAILABLE'],
		"TEMPLATE_THEME" => $arParams['TEMPLATE_THEME'] ?? "",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	),
	$component
); ?>
