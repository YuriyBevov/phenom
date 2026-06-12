<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
	die();
}
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

// \Bitrix\Main\UI\Extension::load('ui.fonts.opensans');
// $this->addExternalCss('/bitrix/css/main/bootstrap.css');
// $this->addExternalCss('/bitrix/css/main/font-awesome.css');

$INPUT_ID = trim($arParams['~INPUT_ID']);
if ($INPUT_ID == '') {
	$INPUT_ID = 'title-search-input';
}
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams['~CONTAINER_ID']);
if ($CONTAINER_ID == '') {
	$CONTAINER_ID = 'title-search';
}
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);
?>

<? if ($arParams['SHOW_INPUT'] !== 'N'): ?>
	<div id="<?php echo $CONTAINER_ID ?>" class="bx-searchtitle">
		<form action="<?php echo $arResult['FORM_ACTION'] ?>">
			<div class="main-input-wrapper">
				<label>
					<input class="main-input" id="<?php echo $INPUT_ID ?>" placeholder="Поиск" type="text" name="q" value="<?= htmlspecialcharsbx($_REQUEST['q'] ?? '') ?>" autocomplete="off" class="bx-form-control" />
				</label>
			</div>
			<button aria-label="Поиск" type="submit" name="s">
				<svg width='16' height='16' role='img' aria-hidden='true' focusable='false'>
					<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-search'></use>
				</svg>
			</button>
		</form>
	</div>
<? endif; ?>

<script>
	BX.ready(function() {
		new JCTitleSearch({
			'AJAX_PAGE': '<?php echo CUtil::JSEscape(POST_FORM_ACTION_URI) ?>',
			'CONTAINER_ID': '<?php echo $CONTAINER_ID ?>',
			'INPUT_ID': '<?php echo $INPUT_ID ?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>