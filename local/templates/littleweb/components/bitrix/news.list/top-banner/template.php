<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

$bannerSizes = [
	"mobile" => ["width" => 760, "height" => 540],
	"tablet" => ["width" => 960, "height" => 480],
	"desktop" => ["width" => 1920, "height" => 720],
];

$getCroppedBanner = function ($fileId, $size) {
	if (!$fileId) {
		return null;
	}

	$image = CFile::ResizeImageGet(
		$fileId,
		$size,
		BX_RESIZE_IMAGE_EXACT,
		true
	);

	if (!empty($image["src"])) {
		return $image;
	}

	$src = CFile::GetPath($fileId);
	if (!$src) {
		return null;
	}

	return [
		"src" => $src,
		"width" => $size["width"],
		"height" => $size["height"],
	];
};

if ($arResult["ITEMS"]): ?>
	<section class="top-banner">
		<div class="container-fluid">
			<div class="swiper">
				<div class="swiper-wrapper">
					<? foreach ($arResult["ITEMS"] as $arItem):
						$mobileImage = $getCroppedBanner($arItem["PROPERTIES"]["MOBILE_IMAGE"]["VALUE"], $bannerSizes["mobile"]);
						$tabletImage = $getCroppedBanner($arItem["PROPERTIES"]["TABLET_IMAGE"]["VALUE"], $bannerSizes["tablet"]);
						$desktopImage = $getCroppedBanner($arItem["PROPERTIES"]["DESKTOP_IMAGE"]["VALUE"], $bannerSizes["desktop"]);
						if ($mobileImage && $tabletImage && $desktopImage):
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
							<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<? if ($arItem["PROPERTIES"]["LINK"]["VALUE"]): ?>
									<a href="<?= htmlspecialcharsbx($arItem["PROPERTIES"]["LINK"]["VALUE"]) ?>">
									<? endif; ?>
									<picture>
										<source srcset="<?= htmlspecialcharsbx($desktopImage["src"]) ?>" media="(min-width: 960px)" width="<?= $desktopImage["width"] ?>" height="<?= $desktopImage["height"] ?>">
										<source srcset="<?= htmlspecialcharsbx($tabletImage["src"]) ?>" media="(min-width: 760px)" width="<?= $tabletImage["width"] ?>" height="<?= $tabletImage["height"] ?>">
										<img src="<?= htmlspecialcharsbx($mobileImage["src"]) ?>" alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>" width="<?= $mobileImage["width"] ?>" height="<?= $mobileImage["height"] ?>">
									</picture>
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
								<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-arrow'></use>
							</svg>
						</button>
						<button class="swiper-btn swiper-btn--next" aria-label="Следующий слайд">
							<svg width='17' height='13' role='img' aria-hidden='true' focusable='false'>
								<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-arrow'></use>
							</svg>
						</button>
					</div>

				</div>
			</div>
		</div>
	</section>
<? endif; ?>