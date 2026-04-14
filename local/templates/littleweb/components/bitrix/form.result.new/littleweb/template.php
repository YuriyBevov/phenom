<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


<section class="section request">
	<div class="container">
		<div class="grid">
			<div class="grid-item">
				<h2 class="title">Оставьте заявку на производство</h2>
				<p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam corrupti magnam distinctio, quisquam obcaecati exercitationem cum porro rem libero placeat nulla qui voluptatum in nisi delectus. Veniam vitae eos nisi?</p>
			</div>
			<div class="grid-item">
				<div class="request-form">
					<?= $arResult["FORM_HEADER"] ?>

					<? if ($arResult["FORM_NOTE"]): ?>
						<div class="request-form__header">
							<span class="request-form__title">Заявка отправлена успешно!</span>
							<p>Спасибо, мы скоро свяжемся с Вами!</p>
						</div>
					<? else: ?>

						<!-- <div class="request-form__header">
							<span class="request-form__title">Форма заявки на создание продукции</span>
						</div> -->

						<div class="grid">
							<? foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>


								<? if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "text"): ?>
									<div class="main-input-wrapper <?= ($arResult["FORM_ERRORS"][$FIELD_SID] ? 'invalid-fld' : '') ?>">
										<label>
											<?= $arQuestion["HTML_CODE"] ?>
										</label>
									</div>
								<? endif; ?>

								<? if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "dropdown"): ?>
									<!-- custom-select ? -->
									<div class="main-dropdown-wrapper <?= ($arResult["FORM_ERRORS"][$FIELD_SID] ? 'invalid-fld' : '') ?>">
										<label>
											<?= $arQuestion["CAPTION"] ?>
											<?= $arQuestion["HTML_CODE"] ?>
										</label>
									</div>
								<? endif; ?>

								<? if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "textarea"): ?>
									<div class="main-textarea-wrapper <?= ($arResult["FORM_ERRORS"][$FIELD_SID] ? 'invalid-fld' : '') ?>">
										<label>
											<?= $arQuestion["HTML_CODE"] ?>
										</label>
									</div>
								<? endif; ?>

								<? if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "checkbox"): ?>
									<div class="main-checkbox-wrapper <?= ($arResult["FORM_ERRORS"][$FIELD_SID] ? 'invalid-fld' : '') ?>">
										<input type="checkbox" id="<?= $arQuestion["STRUCTURE"][0]["ID"] . ($arParams["IS_MODAL"] ? '_modal' : null) ?>" name="form_checkbox_<?= $FIELD_SID ?>[]" value="<?= $arQuestion["STRUCTURE"][0]["ID"] ?>">
										<label class="main-checkbox" for="<?= $arQuestion["STRUCTURE"][0]["ID"] . ($arParams["IS_MODAL"] ? '_modal' : null) ?>">
											<span><?= $arQuestion["CAPTION"] ?><?= ($arQuestion["REQUIRED"] == "Y" ? '*' : '') ?></span>
										</label>
									</div>
								<? endif; ?>

								<? if ($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "hidden"): ?>
									<?= $arQuestion["HTML_CODE"] ?>
								<? endif; ?>
							<? endforeach; ?>
						</div>

						<? if ($arResult["isUseCaptcha"] == "Y"): ?>
							<div class="captcha-block <?= ($arResult["FORM_ERRORS"][0] ? 'invalid-fld' : '') ?>">
								<input type="hidden" name="captcha_sid" value="<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" />
								<div class="main-input-wrapper">
									<label>
										<input type="text" placeholder="Введите символы с картинки" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
									</label>
								</div>
								<div class="captcha-block__img-wrapper">
									<img src="/bitrix/tools/captcha.php?captcha_sid=<?= htmlspecialcharsbx($arResult["CAPTCHACode"]); ?>" width="180" height="40" alt="" />
								</div>
							</div>
						<? endif; ?>

						<?/* $APPLICATION->IncludeComponent(
							"bitrix:main.userconsent.request",
							"",
							array(
								"AUTO_SAVE" => "N",
								"COMPOSITE_FRAME_MODE" => "A",
								"COMPOSITE_FRAME_TYPE" => "AUTO",
								"ID" => "1",
								"IS_CHECKED" => "N",
								"IS_LOADED" => "Y",
								"COMPONENT_TEMPLATE" => ""
							),
							$component
						); */ ?>

						<div class="main-input-wrapper">
							<input
								class="main-btn"
								<?= (intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : ""); ?>
								type="submit" name="web_form_submit"
								value="<?= htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? 'Отправить' : $arResult["arForm"]["BUTTON"]); ?>" />
						</div>
					<? endif; ?>
					<?= $arResult["FORM_FOOTER"] ?>
				</div>
			</div>
		</div>
	</div>
</section>


<? if ($_REQUEST['AJAX_CALL'] == 'Y'): ?>
	<script src="https://unpkg.com/imask"></script>
	<script>
		// BX.UserConsent.loadFromForms();
		var fields = document.querySelectorAll('[data-type="phone"]');
		var options = {
			mask: '+{7}(000) 000-00-00'
		};

		fields.forEach(field => {
			IMask(field, options);
		});
	</script>
<? endif; ?>