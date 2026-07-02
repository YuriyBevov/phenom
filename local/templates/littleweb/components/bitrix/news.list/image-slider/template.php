<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

$reviewTextLimit = 100;
?>

<? if ($arResult["ITEMS"]): ?>


	<section class="section image-slider">
		<div class="container-fluid">
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
						<div class="swiper-slide"
							href="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
							data-fancybox="<?= $arResult["ID"] ?>"
							id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= intval($arItem["PREVIEW_PICTURE"]["WIDTH"]) ?>" height="<?= intval($arItem["PREVIEW_PICTURE"]["HEIGHT"]) ?>" alt="<?= htmlspecialcharsbx($arResult["NAME"]) ?>" loading="lazy">
						</div>
						<div class="swiper-slide"
							href="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
							data-fancybox="<?= $arResult["ID"] ?>"
							id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= intval($arItem["PREVIEW_PICTURE"]["WIDTH"]) ?>" height="<?= intval($arItem["PREVIEW_PICTURE"]["HEIGHT"]) ?>" alt="<?= htmlspecialcharsbx($arResult["NAME"]) ?>" loading="lazy">
						</div>
						<div class="swiper-slide"
							href="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
							data-fancybox="<?= $arResult["ID"] ?>"
							id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" width="<?= intval($arItem["PREVIEW_PICTURE"]["WIDTH"]) ?>" height="<?= intval($arItem["PREVIEW_PICTURE"]["HEIGHT"]) ?>" alt="<?= htmlspecialcharsbx($arResult["NAME"]) ?>" loading="lazy">
						</div>
					<? endforeach; ?>
				</div>
			</div>
		</div>
	</section>


<? endif; ?>