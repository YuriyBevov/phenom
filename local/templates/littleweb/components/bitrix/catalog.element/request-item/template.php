<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$haveOffers = !empty($arResult['OFFERS']);

$templateData = [
	// 'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => [
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
	],
];
if ($haveOffers) {
	$templateData['ITEM']['OFFERS_SELECTED'] = $arResult['OFFERS_SELECTED'];
	$templateData['ITEM']['JS_OFFERS'] = $arResult['JS_OFFERS'];
}
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
	'STICKER_ID' => $mainId . '_sticker',
	'BIG_SLIDER_ID' => $mainId . '_big_slider',
	'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
	'PICT' => $mainId . '_pict',
	'PICT_SLIDER' => $mainId . '_pict_slider',
	'SLIDER_CONT_ID' => $mainId . '_slider_cont',
	'OLD_PRICE_ID' => $mainId . '_old_price',
	'PRICE_ID' => $mainId . '_price',
	'DESCRIPTION_ID' => $mainId . '_description',
	'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
	'PRICE_TOTAL' => $mainId . '_price_total',
	'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
	'QUANTITY_ID' => $mainId . '_quantity',
	'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
	'QUANTITY_UP_ID' => $mainId . '_quant_up',
	'QUANTITY_MEASURE' => $mainId . '_quant_measure',
	'QUANTITY_LIMIT' => $mainId . '_quant_limit',
	'BUY_LINK' => $mainId . '_buy_link',
	'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
	'COMPARE_LINK' => $mainId . '_compare_link',
	'TREE_ID' => $mainId . '_skudiv',
	'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
	'OFFER_GROUP' => $mainId . '_set_group_',
	'BASKET_PROP_DIV' => $mainId . '_basket_prop',
	'SUBSCRIBE_LINK' => $mainId . '_subscribe',
	'TABS_ID' => $mainId . '_tabs',
	'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
	'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);



?>

<div class="bx-catalog-element" id="<?= $itemIds['ID'] ?>">
	<div class="container">
		<div class="grid">
			<?/*
			<div class="grid-item grid-item--gallery">

				<div class="bx-catalog-element-slider-container">
					<div class="swiper --base">
						<div class="swiper-wrapper">
							<? if (!empty($arResult["PROPERTIES"]["GALLERY"]["VALUE"])): ?>
								<? foreach ($arResult["PROPERTIES"]["GALLERY"]["VALUE"] as $arItem):
									$path = CFile::GetPath($arItem);
								?>
									<div class="swiper-slide">
										<img data-fancybox="bx-catalog-element-gallery" src="<?= $path ?>" alt="<?= $alt ?>" width="400" height="300">
									</div>
								<? endforeach; ?>
							<? else: ?>
								<div class="swiper-slide">
									<img src="<?= $templateFolder . '/images/no_photo.png' ?>" alt="<?= $alt ?>" width="400" height="300">
								</div>
							<? endif; ?>
						</div>
						<div class="swiper-pagination" aria-label="Пагинация"></div>
					</div>
				</div>
				<!-- slider -->
			</div>
			*/ ?>
			<div class="grid-item grid-item--main">

				<h1 class="title"><?= $arResult["NAME"] ?></h1>

				<? if (
					$arResult['PREVIEW_TEXT'] != ''
					&& (
						$arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'S'
						|| ($arParams['DISPLAY_PREVIEW_TEXT_MODE'] === 'E' && $arResult['DETAIL_TEXT'] == '')
					)
				): ?>
					<span class="subtitle">Описание запроса:</span><br>
					<?= $arResult['PREVIEW_TEXT_TYPE'] === 'html' ? $arResult['PREVIEW_TEXT'] : '<p>' . $arResult['PREVIEW_TEXT'] . '</p>'; ?>
					<br>
				<? endif; ?>

				<? if (!empty($arResult['DISPLAY_PROPERTIES_WITH_PAIRS'])): ?>
					<span class="subtitle">Условия реализации:</span><br>
					<ul class="prop-list">
						<? foreach ($arResult['DISPLAY_PROPERTIES_WITH_PAIRS'] as $property): ?>
							<li class="prop-list-item">
								<span class="prop-list-item-name"><?= $property['NAME'] ?></span>
								<span class="prop-list-item-value">
									<? if (!empty($property['IS_PAIR'])): ?>
										<span class="prop-list-item-value__pair">
											<? foreach ($property['PROPERTIES'] as $pairPropertyIndex => $pairProperty): ?>
												<span class="prop-list-item-value__pair-item">
													<span class="prop-list-item-value__pair-divider"><?= $pairPropertyIndex === 0 ? '' : ' / ' ?></span>
													<span class="prop-list-item-value__pair-value">
														<?= (
															is_array($pairProperty['DISPLAY_VALUE'])
															? implode(' / ', $pairProperty['DISPLAY_VALUE'])
															: $pairProperty['DISPLAY_VALUE']
														) ?>
													</span>
												</span>
											<? endforeach; ?>
										</span>
									<? else: ?>
										<?= (
											is_array($property['DISPLAY_VALUE'])
											? implode(' / ', $property['DISPLAY_VALUE'])
											: $property['DISPLAY_VALUE']
										) ?>
									<? endif; ?>
								</span>
							</li>
						<?
						endforeach;
						unset($property);
						?>
					</ul>
					<br>
				<? endif; ?>

				<? if (!empty($arResult["PROPERTIES"]["FILES"]["VALUE"])): ?>
					<div class="bx-catalog-element-files">
						<span class="subtitle">Прикрепленные документы:</span>

						<ul class="files-list">
							<? foreach ($arResult["PROPERTIES"]["FILES"]["VALUE"] as $arItem):
								$file = CFile::GetFileArray($arItem);
							?>
								<li>
									<a href="<?= $file["SRC"] ?>" download>
										<img src="<?= SITE_TEMPLATE_PATH  . '/_dist/images/doc-icon.png' ?>" alt="Иконка" width="24" height="24">
										<span><?= $file["ORIGINAL_NAME"] ?></span>
										<img src="<?= SITE_TEMPLATE_PATH  . '/_dist/images/download-icon.png' ?>" alt="Иконка" width="32" height="32">
									</a>
								</li>
							<? endforeach; ?>
						</ul>
					</div>
				<? endif; ?>






			</div>

			<div class="grid-item grid-item--side">
				<span class="subtitle">Информация о заказчике:</span>
				<br>
				<div class="company-row">
					<img src="<?= $arResult["PREVIEW_PICTURE"]["SRC"] ?>" alt="">
					<ul class="prop-list">
						<? if ($arResult["PROPERTIES"]["COMPANY_NAME"]["VALUE"]): ?>
							<li class="prop-list-item">
								<span class="prop-list-item-name">Название компании:</span>
								<span class="prop-list-item-value"><?= $arResult["PROPERTIES"]["COMPANY_NAME"]["VALUE"] ?></span>
							</li>
						<? endif; ?>

						<? if ($arResult["PROPERTIES"]["COMPANY_CITY"]["VALUE"]): ?>
							<li class="prop-list-item">
								<span class="prop-list-item-name">Город:</span>
								<span class="prop-list-item-value"><?= $arResult["PROPERTIES"]["COMPANY_CITY"]["VALUE"] ?></span>
							</li>
						<? endif; ?>

						<? if ($arResult["PROPERTIES"]["COMPANY_INN"]["VALUE"]): ?>
							<li class="prop-list-item">
								<span class="prop-list-item-name">ИНН:</span>
								<span class="prop-list-item-value"><?= $arResult["PROPERTIES"]["COMPANY_INN"]["VALUE"] ?></span>
							</li>
						<? endif; ?>

						<? if ($arResult["PROPERTIES"]["COMPANY_ADDRESS"]["VALUE"]): ?>
							<li class="prop-list-item">
								<span class="prop-list-item-name">Юридический адрес:</span>
								<span class="prop-list-item-value"><?= $arResult["PROPERTIES"]["COMPANY_ADDRESS"]["VALUE"] ?></span>
							</li>
						<? endif; ?>
					</ul>
				</div>

				<div class="bx-catalog-element-btn-row">
					<button class="main-btn" data-form-id="3">Оставить заявку</button>
					<button class="main-btn outlined" data-form-id="2">Остались вопросы ?</button>
				</div>
			</div>
		</div>
	</div>
</div>