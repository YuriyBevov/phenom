<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

<section class="section service-detail">
	<div class="page-head<?= ($arResult["DETAIL_PICTURE"]["SRC"] ? ' page-head--bg' : '') ?>" <?= ($arResult["DETAIL_PICTURE"]["SRC"] ? 'style="background-image:url(' . $arResult["DETAIL_PICTURE"]["SRC"] . ')" ' : '') ?>>
		<div class="container">
			<h1 class="page-head-title"><?= $arResult["NAME"] ?></h1>
			<? if ($arResult["PROPERTIES"]["DETAIL_PREVIEW_TEXT"]["VALUE"]): ?>
				<p class="page-head-description">
					<?= $arResult["PROPERTIES"]["DETAIL_PREVIEW_TEXT"]["VALUE"] ?>
				</p>
			<? endif ?>
			<button class="main-btn" data-form-id="1">Оставить заявку</button>
		</div>
	</div>

	<div class="container content-block">
		<?= $arResult["DETAIL_TEXT"] ?>
	</div>
</section>

<?
global $serviceDetailLinkedExamplesFilter;

$linkedExamples = $arResult["PROPERTIES"]["LINKED_EXAMPLES"]["VALUE"] ?? [];

if (!is_array($linkedExamples)) {
	$linkedExamples = [$linkedExamples];
}

$linkedExamples = array_values(array_filter(array_map("intval", $linkedExamples)));
$serviceDetailLinkedExamplesFilter = [
	"ID" => $linkedExamples,
];

if ($linkedExamples):
?>
	<? $APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"portfolio-list",
		[
			"IS_LINKED" => "Y",
			"CUSTOM_TITLE" => "Лучшие работы",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_FILTER" => "Y",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "/portfolio/#ELEMENT_CODE#/",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"DISPLAY_DATE" => "N",
			"DISPLAY_NAME" => "N",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => [
				0 => "",
				1 => "",
			],
			"FILTER_NAME" => "serviceDetailLinkedExamplesFilter",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "19",
			"IBLOCK_TYPE" => "site_content",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "N",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "100",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => [
				0 => "SHOW_ON_INDEX_PAGE",
				1 => "",
			],
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC",
			"STRICT_SECTION_CHECK" => "N",
			"COMPONENT_TEMPLATE" => "portfolio-preview",
			"NOTE" => ""
		],
		$component
	);  ?>
<? endif; ?>

<?
global $serviceLinkedFilter;
$serviceSectionId = intval($arResult["IBLOCK_SECTION_ID"] ?? 0);
$serviceLinkedFilter = [
	"!ID" => intval($arResult["ID"]),
];

if ($serviceSectionId):
?>

	<? $APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"linked-services",
		[
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_FILTER" => "Y",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "/news/#ELEMENT_CODE#/",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"DISPLAY_DATE" => "N",
			"DISPLAY_NAME" => "N",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "N",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => [
				0 => "",
				1 => "",
			],
			"FILTER_NAME" => "serviceLinkedFilter",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => $arResult["IBLOCK_ID"],
			"IBLOCK_TYPE" => "site_content",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "N",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "100",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => $serviceSectionId,
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => [
				0 => "SHOW_ON_INDEX_PAGE",
				1 => "",
			],
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC",
			"STRICT_SECTION_CHECK" => "N",
			"COMPONENT_TEMPLATE" => "linked-services",
			"NOTE" => ""
		],
		$component
	);  ?>
<? endif; ?>