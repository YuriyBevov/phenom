<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<section class="section service-detail">
	<div class="page-head" <?= ($arResult["DETAIL_PICTURE"]["SRC"] ? 'style="background-image:url(' . $arResult["DETAIL_PICTURE"]["SRC"] . ')" ' : '') ?>>
		<div class="container">
			<h1 class="page-head-title"><?= $arResult["NAME"] ?></h1>
			<? if ($arResult["PROPERTIES"]["DETAIL_PREVIEW_TEXT"]["VALUE"]): ?>
				<p class="page-head-description">
					<?= $arResult["PROPERTIES"]["DETAIL_PREVIEW_TEXT"]["VALUE"] ?>
				</p>
			<? endif ?>
			<button class="main-btn" data-form-id="1">Оставить заявку</button>
		</div>
	</div>

	<div class="container content-block">
		<?= $arResult["DETAIL_TEXT"] ?>
	</div>
</section>