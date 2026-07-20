<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);


if ($arResult["ITEMS"]): ?>
	<section class="section news-list">

		<? if ($arParams["IS_INNER"] === "Y"): ?>
			<div class="page-head<?= (CFile::GetPath($arResult["PICTURE"]) ? ' page-head--bg' : '') ?>" <?= (CFile::GetPath($arResult["PICTURE"]) ? 'style="background-image:url(' . CFile::GetPath($arResult["PICTURE"]) . ')" ' : '') ?>>
				<div class="container">
					<h1 class="page-head-title"><?= $arResult["NAME"] ?></h1>
					<? if ($arResult["DESCRIPTION"]): ?>
						<p class="page-head-description">
							<?= $arResult['DESCRIPTION'] ?>
						</p>
					<? endif ?>
					<button class="main-btn" data-form-id="1">Оставить заявку</button>
				</div>
			</div>
		<? endif; ?>

		<div class="container">

			<? if ($arParams["IS_INNER"] !== "Y"): ?>
				<div class="section__header">
					<h2><?= $arResult["NAME"] ?></h2>
					<? if ($arResult["DESCRIPTION"]): ?>
						<p>
							<?= $arResult["DESCRIPTION"] ?>
						</p>
					<? endif; ?>
				</div>
			<? endif; ?>

			<div class="news-list__grid">
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
					<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="news-list__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="400" height="300">
						<span class="news-list__item-title"><?= $arItem["NAME"] ?></span>
						<span class="news-list__item-preview-text"><?= $arItem["PREVIEW_TEXT"] ?></span>
						<small class="news-list__item-date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></small>
					</a>
				<? endforeach; ?>
			</div>

			<? if ($arParams["IS_INNER"] !== "Y"): ?>
				<a href="/news/" class="main-btn">Все статьи</a>
			<? else: ?>
				<? if ($arParams["DISPLAY_BOTTOM_PAGER"] || $arParams["DISPLAY_TOP_PAGER"]): ?>
					<?= $arResult["NAV_STRING"] ?>
				<? endif; ?>
			<? endif; ?>
		</div>
	</section>
<? endif; ?>