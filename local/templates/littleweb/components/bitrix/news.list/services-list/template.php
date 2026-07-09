<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>


<? if ($arResult["SERVICE_SECTIONS"]): ?>
	<section class="section services-list">
		<? $index = 0;
		foreach ($arResult["SERVICE_SECTIONS"] as $arSection): ?>
			<? if ($index === 0 && $arResult["PICTURE"]): ?>
				<div class="services-list__bg-image-wrapper" aria-hidden="true">
					<img src="<?= CFile::GetPath($arResult["PICTURE"]) ?>" alt="" width="960" height="480">
				</div>
			<? endif; ?>
			<div class="services-list__section">
				<div class="container">

					<div class="section__header">
						<h2><?= $arSection["NAME"] ?></h2>
						<? if ($arSection["DESCRIPTION"]): ?>
							<div>
								<? if ($arSection["DESCRIPTION_TYPE"] === "html"): ?>
									<?= $arSection["DESCRIPTION"] ?>
								<? else: ?>
									<p><?= nl2br(htmlspecialcharsbx($arSection["DESCRIPTION"])) ?></p>
								<? endif; ?>
							</div>
						<? endif; ?>
					</div>

					<div class="services-list__grid">
						<? foreach ($arSection["ITEMS"] as $arItem):
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
							<? if ($arItem["PREVIEW_TEXT"] && $arItem["DETAIL_PAGE_URL"]): ?>
								<div class="services-list-card-container">
									<a <?= ($arItem["PREVIEW_PICTURE"]["SRC"] ? 'style="background-image:url(' . $arItem["PREVIEW_PICTURE"]["SRC"] . ')" ' : '') ?> href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="services-list-card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
										<div class="services-list-card__header">
											<? if (!empty($arItem["PROPERTIES"]["THEME"]["VALUE"])): ?>
												<small><?= $arItem["PROPERTIES"]["THEME"]["VALUE"] ?></small>
											<? endif; ?>
											<!-- <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="400" height="400"> -->
											<span><?= $arItem["NAME"] ?></span>
										</div>

										<div class="services-list-card__content">
											<p><?= $arItem["PREVIEW_TEXT"] ?></p>
										</div>

										<svg width='16' height='16' role='img' aria-hidden='true' focusable='false'>
											<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-arrow'></use>
										</svg>
									</a>
								</div>
							<? endif; ?>
						<? endforeach; ?>
					</div>

					<a class="main-btn" href="<?= $arSection["SECTION_PAGE_URL"] ?>">Перейти в раздел</a>
				</div>
			</div>
		<? $index++;
		endforeach; ?>
	</section>
<? endif; ?>