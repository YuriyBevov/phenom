<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if ($arResult["ITEMS"]): ?>
	<section class="section brands">
		<div class="container">
			<?
			$APPLICATION->IncludeFile(
				SITE_TEMPLATE_PATH . '/include/section-header.php',
				array(
					'TITLE' =>  $arResult["NAME"],
					'DESCRIPTION' => $arResult["DESCRIPTION"],
					'DETAIL_LINK' => $arREsult["LIST_PAGE_URL"],
					'DETAIL_LINK_TEXT' => "Смотреть все"
				),
				array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
			);
			?>

			<? if ($arParams["USE_SLIDER"] && $arParams["USE_SLIDER"] === "Y"): ?>
				<? include_once(__DIR__ . '/slider-view.php') ?>
			<? else: ?>
				<? include_once(__DIR__ . '/grid-view.php') ?>
			<? endif; ?>

		</div>
	</section>

<? endif; ?>