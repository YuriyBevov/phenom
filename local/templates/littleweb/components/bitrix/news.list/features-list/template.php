<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);


if ($arResult["ITEMS"]): ?>
	<section class="section features-list">
		<div class="container">

			<div class="section__header">
				<h2><?= $arResult["NAME"] ?></h2>
				<? if ($arResult["DESCRIPTION"]): ?>
					<p>
						<?= $arResult["DESCRIPTION"] ?>
					</p>
				<? endif; ?>
			</div>

			<div class="features-list__grid">
				<div class="features-list__grid-item">
					<? foreach ($arResult["ITEMS"] as $index => $arItem):
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
						<div class="features-list__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<svg width='16' height='16' role='img' aria-hidden='true' focusable='false'>
								<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-check'></use>
							</svg>
							<span><?= $arItem["~NAME"] ?></span>
						</div>
					<? endforeach; ?>
				</div>
				<div class="features-list__grid-item">
					<img src="<?= CFile::GetPath($arResult["PICTURE"])  ?>" alt="<?= $arResult["NAME"] ?>" width="640px" height="480">
				</div>
			</div>
		</div>
	</section>
<? endif; ?>