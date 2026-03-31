<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<div class="bottom-menu">
	<? if ($arParams["MENU_TITLE"]): ?>
		<span class="bottom-menu__title">
			<?= $arParams["MENU_TITLE"] ?>
		</span>
	<? endif; ?>
	<ul>
		<? foreach ($arResult as $arItem): ?>
			<li>
				<a href="<?= $arItem["LINK"] ?>" class="<?= ($arItem["SELECTED"] ? 'selected' : '') ?>">
					<?= $arItem["TEXT"] ?>
				</a>
			</li>
		<? endforeach; ?>
	</ul>
</div>