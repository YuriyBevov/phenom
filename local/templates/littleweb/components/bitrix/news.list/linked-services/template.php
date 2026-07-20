<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if (!empty($arResult["ITEMS"])): ?>

	<section class="section linked-services-list">
		<div class="container">
			<div class="section__header">
				<h2>Вам может быть интересно</h2>
			</div>

			<div class="linked-services-list__grid">
				<? foreach ($arResult["ITEMS"] as $arItem):  ?>
					<div class="linked-services-list-card-container">
						<a <?= ($arItem["PREVIEW_PICTURE"]["SRC"] ? 'style="background-image:url(' . $arItem["PREVIEW_PICTURE"]["SRC"] . ')" ' : '') ?> href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="linked-services-list-card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<div class="linked-services-list-card__header">
								<? if (!empty($arItem["PROPERTIES"]["THEME"]["VALUE"])): ?>
									<small><?= $arItem["PROPERTIES"]["THEME"]["VALUE"] ?></small>
								<? endif; ?>
								<span><?= $arItem["NAME"] ?></span>
							</div>

							<div class="linked-services-list-card__content">
								<p><?= $arItem["PREVIEW_TEXT"] ?></p>
							</div>

							<svg width='16' height='16' role='img' aria-hidden='true' focusable='false'>
								<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-arrow'></use>
							</svg>
						</a>
					</div>
				<? endforeach; ?>
			</div>
		</div>
	</section>

<? endif; ?>