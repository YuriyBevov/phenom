<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

// debug($arResult);
?>

<section class="section portfolio-detail">
	<div class="page-head">
		<div class="container">
			<img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ? $arResult["DETAIL_PICTURE"]["SRC"] : $arResult["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arResult["NAME"] ?>" width="480" height="480">

			<div class="page-head-content-wrapper">
				<h1 class="page-head-title">
					<?= $arResult["NAME"] ?>
				</h1>
				<? if ($arResult["PREVIEW_TEXT"]): ?>
					<p class="page-head-description">
						<?= $arResult["PREVIEW_TEXT"] ?>
					</p>
				<? endif; ?>
				<button class="main-btn" data-form-id="1">Оставить заявку</button>
			</div>
		</div>
	</div>

	<div class="container">
		<? if ($arResult["DETAIL_TEXT"]): ?>
			<div class="content-block">
				<? if ($arResult["DETAIL_TEXT_TYPE"] === 'html'): ?>
					<?= $arResult["DETAIL_TEXT"] ?>
				<? else: ?>
					<p><?= $arResult["DETAIL_TEXT"] ?></p>
				<? endif; ?>
			</div>
		<? endif; ?>

		<!-- <h2 class="title">Тут должны быть характеристики проекта или достаточно детального описания ? Какие ? В каком виде ?</h2> -->

		<? if ($arResult["PROPERTIES"]["GALLERY"]["VALUE"]): ?>

			<div class="gallery">

				<? foreach ($arResult["PROPERTIES"]["GALLERY"]["VALUE"] as $arValue):
					$arItem = CFile::GetFileArray($arValue);
				?>
					<? if ($arItem): ?>
						<div class="gallery__item">
							<a
								class="gallery__item-wrapper"
								href="<?= $arItem['SRC'] ?>"
								data-fancybox="portfolio-detail-gallery">
								<img src="<?= $arItem['SRC'] ?>" alt="<?= htmlspecialcharsbx($arItem['DESCRIPTION'] ? $arItem['DESCRIPTION'] : $arItem['ORIGINAL_NAME']) ?>" width="<?= intval($arItem['WIDTH']) ?>" height="<?= intval($arItem['HEIGHT']) ?>" loading="lazy">
							</a>
						</div>
					<? endif; ?>
				<? endforeach; ?>
			</div>
		<? endif; ?>
	</div>

</section>

<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"image-creeper-line",
	[
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
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
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "15",
		"IBLOCK_TYPE" => "site_content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "",
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
			0 => "",
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
		"COMPONENT_TEMPLATE" => "image-creeper-line"
	],
	$component
); ?>

<?
global $portfolioDetailLinkedWorksFilter;
$portfolioDetailLinkedWorksFilter = [
	"!ID" => intval($arResult["ID"]),
];
?>

<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"portfolio-list",
	[
		"IS_LINKED" => "Y",
		"CUSTOM_TITLE" => "Другие работы",
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
		"FILTER_NAME" => "portfolioDetailLinkedWorksFilter",
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