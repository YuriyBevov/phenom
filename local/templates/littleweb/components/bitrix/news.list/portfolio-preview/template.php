<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["ITEMS"]): ?>

	<section class="section portfolio-preview">
		<div class="container">
			<div class="section__header">
				<h2><?= $arResult["NAME"] ?></h2>
				<? if ($arResult["DESCRIPTION"]): ?>
					<p>
						<?= $arResult["DESCRIPTION"] ?>
					</p>
				<? endif; ?>
			</div>

			<div class="swiper autofill-slider">
				<div class="swiper-wrapper">
					<? foreach ($arResult["ITEMS"] as $arItem):
						$previewPicture = $arItem["PREVIEW_PICTURE"];
						$previewPictureSmall = false;
						$previewPictureMedium = false;
						$previewPictureLarge = false;

						if (!empty($previewPicture["ID"])) {
							$previewPictureSmall = CFile::ResizeImageGet(
								$previewPicture["ID"],
								["width" => 320, "height" => 320],
								BX_RESIZE_IMAGE_PROPORTIONAL,
								true
							);
							$previewPictureMedium = CFile::ResizeImageGet(
								$previewPicture["ID"],
								["width" => 560, "height" => 560],
								BX_RESIZE_IMAGE_PROPORTIONAL,
								true
							);
							$previewPictureLarge = CFile::ResizeImageGet(
								$previewPicture["ID"],
								["width" => 800, "height" => 800],
								BX_RESIZE_IMAGE_PROPORTIONAL,
								true
							);
						}

						$previewPictureSrc = $previewPictureMedium["src"] ?? $previewPicture["SRC"];
						$previewPictureWidth = intval($previewPictureMedium["width"] ?? $previewPicture["WIDTH"] ?? 0);
						$previewPictureHeight = intval($previewPictureMedium["height"] ?? $previewPicture["HEIGHT"] ?? 0);
						$previewPictureSrcset = array_filter([
							$previewPictureSmall ? $previewPictureSmall["src"] . " 320w" : null,
							$previewPictureMedium ? $previewPictureMedium["src"] . " 560w" : null,
							$previewPictureLarge ? $previewPictureLarge["src"] . " 800w" : null,
						]);

						$this->AddEditAction(
							$arItem['ID'],
							$arItem['EDIT_LINK'],
							CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
						);
						$this->AddDeleteAction(
							$arItem['ID'],
							$arItem['DELETE_LINK'],
							CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
							["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]
						);
					?>
						<a class="swiper-slide"
							href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
							id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<img src="<?= $previewPictureSrc ?>" <? if ($previewPictureSrcset): ?>srcset="<?= htmlspecialcharsbx(implode(", ", $previewPictureSrcset)) ?>" sizes="(max-width: 767px) 70vw, 540px" <? endif; ?> alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>" width="<?= $previewPictureWidth ?>" height="<?= $previewPictureHeight ?>">
						</a>
						<a class="swiper-slide"
							href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
							id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<img src="<?= $previewPictureSrc ?>" <? if ($previewPictureSrcset): ?>srcset="<?= htmlspecialcharsbx(implode(", ", $previewPictureSrcset)) ?>" sizes="(max-width: 767px) 70vw, 540px" <? endif; ?> alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>" width="<?= $previewPictureWidth ?>" height="<?= $previewPictureHeight ?>">
						</a>
						<a class="swiper-slide"
							href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
							id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<img src="<?= $previewPictureSrc ?>" <? if ($previewPictureSrcset): ?>srcset="<?= htmlspecialcharsbx(implode(", ", $previewPictureSrcset)) ?>" sizes="(max-width: 767px) 70vw, 540px" <? endif; ?> alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>" width="<?= $previewPictureWidth ?>" height="<?= $previewPictureHeight ?>">
						</a>
						<a class="swiper-slide"
							href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
							id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<img src="<?= $previewPictureSrc ?>" <? if ($previewPictureSrcset): ?>srcset="<?= htmlspecialcharsbx(implode(", ", $previewPictureSrcset)) ?>" sizes="(max-width: 767px) 70vw, 540px" <? endif; ?> alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>" width="<?= $previewPictureWidth ?>" height="<?= $previewPictureHeight ?>">
						</a>
					<? endforeach; ?>
				</div>
			</div>
		</div>
	</section>
<? endif; ?>