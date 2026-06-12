<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="popup-form">
	<?= $arResult["FORM_HEADER"] ?>

	<? if ($arResult["FORM_NOTE"]): ?>
		<div class="popup-form__note">
			<img src="/source/icons/check_circle.svg" alt="Иконка успеха" width="60" height="60">
			<p>Спасибо!<br>Данные формы успешно отправлены!</p>
		</div>
	<? else: ?>

		<div class="popup-form__header">
			<? if ($arResult["FORM_TITLE"]): ?>
				<span class="popup-form__header-title">
					<?= $arResult["FORM_TITLE"] ?>
				</span>
			<? endif; ?>

			<? if ($arResult["FORM_DESCRIPTION"]): ?>
				<span class="popup-form__header-text">
					<?= $arResult["FORM_DESCRIPTION"] ?>
				</span>
			<? endif; ?>
		</div>

		<div class="popup-form__content">
			<? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
				<? if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'):
					echo $arQuestion["HTML_CODE"];
				else: ?>

					<? if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] === "text"): ?>
						<div class="main-input-wrapper<?= ($arResult["FORM_ERRORS"][$FIELD_SID] ? ' invalid-fld' : '') ?>">
							<label>
								<span><?= $arQuestion["CAPTION"] ?><span class="required-mark"><?= ($arQuestion["REQUIRED"] == "Y" ? '*' : '') ?></span></span>
								<?= $arQuestion["HTML_CODE"] ?>
							</label>
						</div>
					<? endif; ?>

					<? if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] === "checkbox"): ?>
						<div class="main-switcher-wrapper<?= ($arResult["FORM_ERRORS"][$FIELD_SID] ? ' invalid-fld' : '') ?>">
							<label for="<?= $arQuestion["STRUCTURE"][0]["FIELD_ID"] ?>">
								<span><?= $arQuestion["CAPTION"] ?>
									<span class="required-mark"><?= ($arQuestion["REQUIRED"] == "Y" ? '*' : '') ?></span>
								</span>
							</label>
							<input type="checkbox" id="<?= $arQuestion["STRUCTURE"][0]["FIELD_ID"] ?>" value="<?= $arQuestion["STRUCTURE"][0]["FIELD_ID"] ?>" name="<?= 'form_' . $arQuestion["STRUCTURE"][0]["FIELD_TYPE"] . '_' . $FIELD_SID . '[]' ?>">
						</div>
					<? endif; ?>

					<? if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] === "textarea"): ?>

						<div class="main-textarea-wrapper<?= ($arResult["FORM_ERRORS"][$FIELD_SID] ? ' invalid-fld' : '') ?>">
							<label>
								<span>
									<?= $arQuestion["CAPTION"] ?>
									<span class="required-mark"><?= ($arQuestion["REQUIRED"] == "Y" ? '*' : '') ?></span>
								</span>
								<?= $arQuestion["HTML_CODE"] ?>
							</label>
						</div>
					<? endif; ?>
				<? endif; ?>
			<? endforeach; ?>

			<p class="popup-form__required-hint">
				<span class="required-mark">*</span> - обязательные поля
			</p>

			<input class="main-btn" type="submit" name="web_form_submit" value="<?= $arResult["arForm"]["BUTTON"] ?>" />

			<?= $arResult["FORM_FOOTER"] ?>
		</div>

	<? endif; ?>
</div>

<? if ($_REQUEST['AJAX_CALL'] == 'Y'): ?>
	<script>
		window.initImask();
	</script>
<? endif; ?>