<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<section class="section news-detail">
	<div class="page-head">
		<div class="container">
			<? if ($arResult["DETAIL_PICTURE"]["SRC"] || $arResult["PREVIEW_PICTURE"]["SRC"]): ?>
				<img src="<?= ($arResult["DETAIL_PICTURE"]["SRC"] ? $arResult["DETAIL_PICTURE"]["SRC"] : $arResult["PREVIEW_PICTURE"]["SRC"]) ?>" alt="<?= $arResult["NAME"] ?>" width="1024" height="768">

				<div class="page-head-content-wrapper">
				<? endif; ?>
				<h1 class="page-head-title"><?= $arResult["NAME"] ?></h1>
				<? if ($arResult["PREVIEW_TEXT"]): ?>
					<p class="page-head-description">
						<?= $arResult['PREVIEW_TEXT'] ?>
					</p>
				<? endif ?>

				<? if ($arResult["DETAIL_PICTURE"]["SRC"] || $arResult["PREVIEW_PICTURE"]["SRC"]): ?>
				</div>
			<? endif ?>
		</div>
	</div>
	<div class="container">
		<div class="news-detail__content">
			<?= $arResult["DETAIL_TEXT"] ?>
		</div>
	</div>
</section>