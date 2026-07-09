<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);


if ($arResult["ITEMS"]): ?>
	<section class="section news-list">
		<div class="container">

			<div class="section__header">
				<h2><?= $arResult["NAME"] ?></h2>
				<? if ($arResult["DESCRIPTION"]): ?>
					<p>
						<?= $arResult["DESCRIPTION"] ?>
					</p>
				<? endif; ?>
			</div>

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
					<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="news-list__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="400" height="300">
						<span class="news-list__item-title"><?= $arItem["NAME"] ?></span>
						<span class="news-list__item-preview-text"><?= $arItem["PREVIEW_TEXT"] ?></span>
						<small class="news-list__item-date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></small>
					</a>
					<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="news-list__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="400" height="300">
						<span class="news-list__item-title"><?= $arItem["NAME"] ?></span>
						<span class="news-list__item-preview-text"><?= $arItem["PREVIEW_TEXT"] ?></span>
						<small class="news-list__item-date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></small>
					</a>
					<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="news-list__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="400" height="300">
						<span class="news-list__item-title"><?= $arItem["NAME"] ?></span>
						<span class="news-list__item-preview-text"><?= $arItem["PREVIEW_TEXT"] ?></span>
						<small class="news-list__item-date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></small>
					</a>

				<? endforeach; ?>
			</div>

			<a href="/news/" class="main-btn">Все статьи</a>
		</div>
	</section>
<? endif; ?>