<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["ITEMS"]): ?>
	<section class="section portfolio-list">
		<? if ($arParams["IS_INNER"]): ?>
			<div class="page-head<?= (CFile::GetPath($arResult["PICTURE"]) ? ' page-head--bg' : '') ?>" <?= (CFile::GetPath($arResult["PICTURE"]) ? 'style="background-image:url(' . CFile::GetPath($arResult["PICTURE"]) . ')" ' : '') ?>>
				<div class="container">
					<h1 class="page-head-title">
						<?= $arResult["NAME"] ?>
					</h1>
					<? if ($arResult["DESCRIPTION"]): ?>
						<p class="page-head-description">
							<?= $arResult["DESCRIPTION"] ?>
						</p>
					<? endif; ?>
					<button class="main-btn" data-form-id="1">Оставить заявку</button>
				</div>
			</div>
		<? endif; ?>

		<div class="container">
			<? if ($arParams["IS_LINKED"]): ?>
				<div class="section__header">
					<h2><?= ($arParams["CUSTOM_TITLE"] ? $arParams["CUSTOM_TITLE"] : $arResult["NAME"]) ?></h2>
				</div>
			<? endif; ?>

			<div class="portfolio-list__grid">
				<? foreach ($arResult["ITEMS"] as $arItem):
					$previewPicture = $arItem["PREVIEW_PICTURE"];
					$previewPictureSrc = $previewPicture["SRC"] ?? "";
					$previewPictureWidth = intval($previewPicture["WIDTH"] ?? 0);
					$previewPictureHeight = intval($previewPicture["HEIGHT"] ?? 0);

					$this->AddEditAction(
						$arItem["ID"],
						$arItem["EDIT_LINK"],
						CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
					);
					$this->AddDeleteAction(
						$arItem["ID"],
						$arItem["DELETE_LINK"],
						CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
						["CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")]
					);
				?>
					<? if ($previewPictureSrc): ?>
						<a
							class="portfolio-list__item"
							href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
							id="<?= $this->GetEditAreaId($arItem["ID"]); ?>">
							<img
								src="<?= $previewPictureSrc ?>"
								alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>"
								width="<?= $previewPictureWidth ?>"
								height="<?= $previewPictureHeight ?>"
								loading="lazy">

							<span class="main-btn">Подробнее о проекте</span>
						</a>
					<? endif; ?>
				<? endforeach; ?>
			</div>
		</div>
	</section>
<? endif; ?>