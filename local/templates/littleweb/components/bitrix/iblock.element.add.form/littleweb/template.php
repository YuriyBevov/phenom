<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(false);

?>
<section class="section add-request">
	<div class="container">
		<div class="section-header">
			<h2 class="title">Оставьте заявку на производство</h2>
			<p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam corrupti magnam distinctio, quisquam obcaecati exercitationem cum porro rem libero placeat nulla qui voluptatum in nisi delectus. Veniam vitae eos nisi?</p>
		</div>
		<div class="add-request-form">
			<? if ($arResult["MESSAGE"] !== ''): ?>
				<div class="add-request-form__success">
					<span class="subtitle"><? ShowNote($arResult["MESSAGE"]) ?></span>
					<a href="/add-request/" class="main-btn">Оставить новую заявку</a>
				</div>
			<? else: ?>
				<? if (!empty($arResult["ERRORS"])): ?>
					<ul class="add-request-form__error-list">
						<? foreach ($arResult["ERRORS"] as $error): ?>
							<li><span><?= $error ?></span></li>
						<? endforeach; ?>
					</ul>
				<? endif; ?>

				<form name="iblock_add" action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data">
					<?= bitrix_sessid_post() ?>
					<? if ($arParams["MAX_FILE_SIZE"] > 0): ?>
						<input type="hidden" name="MAX_FILE_SIZE" value="<?= $arParams["MAX_FILE_SIZE"] ?>" />
					<? endif ?>

					<fieldset class="fieldset fieldset--request-info">
						<span class="subtitle">Информация о заказе</span>
						<?= $arResult["RENDER_PROPERTIES_FUNCTION"]($arResult["GROUPED_PROPERTY_IDS"]["REQUEST_FIELDS"], $arResult["GROUPED_PROPERTIES"]["REQUEST_FIELDS"], $arResult, $arParams); ?>
					</fieldset>

					<fieldset class="fieldset fieldset--company-info">
						<span class="subtitle">Информация о заказчике</span>
						<?= $arResult["RENDER_PROPERTIES_FUNCTION"]($arResult["GROUPED_PROPERTY_IDS"]["COMPANY_FIELDS"], $arResult["GROUPED_PROPERTIES"]["COMPANY_FIELDS"], $arResult, $arParams); ?>

						<? if ($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0): ?>
							<div class="add-request-form__field">
								<label class="add-request-form__field-title"><?= GetMessage("IBLOCK_FORM_CAPTCHA_TITLE") ?></label>
								<input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>" />
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>" width="180" height="40" alt="CAPTCHA" />
							</div>
							<div class="add-request-form__field">
								<label class="add-request-form__field-title"><?= GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT") ?><span class="starrequired">*</span>:</label>
								<input type="text" name="captcha_word" maxlength="50" value="">
							</div>
						<? endif ?>
					</fieldset>

					<div class="add-request-form__footer">
						<span><span class="starrequired">*</span> - поля обязательные для заполнения.</span>
						<input class="main-btn" type="submit" name="iblock_submit" value="<?= GetMessage("IBLOCK_FORM_SUBMIT") ?>" />
						<? if ($arParams["LIST_URL"] <> ''): ?>
							<input class="main-btn" type="submit" name="iblock_apply" value="<?= GetMessage("IBLOCK_FORM_APPLY") ?>" />
							<input type="button" class="main-btn" name="iblock_cancel" value="<?= GetMessage('IBLOCK_FORM_CANCEL'); ?>" onclick="location.href='<?= CUtil::JSEscape($arParams["LIST_URL"]) ?>';">
						<? endif ?>


					</div>


				</form>
			<? endif; ?>
		</div>
	</div>
</section>