<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if ($arResult["ITEMS"]): ?>
	<section class="top-banner">
		<div class="container">
			<div class="swiper">
				<div class="swiper-wrapper">
					<? foreach ($arResult["ITEMS"] as $arItem):
						if ($arItem["PREVIEW_PICTURE"]["SRC"]):

							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

					?>
							<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<? if ($arItem["PROPERTIES"]["LINK"]["VALUE"]): ?>
									<a href="<?= $arItem["PROPERTIES"]["LINK"]["VALUE"] ?>">
									<? endif; ?>
									<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="1500" height="360">
									<? if ($arItem["PROPERTIES"]["LINK"]["VALUE"]): ?>
									</a>
								<? endif; ?>
							</div>
					<? endif;
					endforeach; ?>
				</div>

				<div class="top-banner__navigation-row">
					<div class="swiper-pagination"></div>

					<div class="swiper-navigation">
						<button class="swiper-btn swiper-btn--prev" aria-label="Предыдущий слайд">
							<svg width='17' height='13' role='img' aria-hidden='true' focusable='false'>
								<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#slider-arrow-icon'></use>
							</svg>
						</button>
						<button class="swiper-btn swiper-btn--next" aria-label="Следующий слайд">
							<svg width='17' height='13' role='img' aria-hidden='true' focusable='false'>
								<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#slider-arrow-icon'></use>
							</svg>
						</button>
					</div>

				</div>
			</div>
		</div>
	</section>
<? endif; ?>