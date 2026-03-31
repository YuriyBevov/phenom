<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arItems = $arResult["arrResults"];
?>

<? if ($arItems): ?>
	<section class="section request-preview">
		<div class="container">
			<?
			$APPLICATION->IncludeFile(
				SITE_TEMPLATE_PATH . '/include/section-header.php',
				array(
					'TITLE' =>  "Запросы закупщиков",
					'DESCRIPTION' => $arResult["DESCRIPTION"],
					'DETAIL_LINK' => "/requests-list/",
					'DETAIL_LINK_TEXT' => "Смотреть все"
				),
				array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
			);
			?>

			<div class="swiper --autofill">
				<div class="swiper-wrapper">
					<? foreach ($arItems as $arItem):
						$count = $arResult["arrAnswersSID"][$arItem["ID"]]["COUNT"][0]["USER_TEXT"];
						$price = number_format(floatval($arResult["arrAnswersSID"][$arItem["ID"]]["MAX_PRICE"][0]["USER_TEXT"]), 0, ' ', ' ');
					?>

						<div class="swiper-slide">
							<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="request-preview-card">
								<div class="request-preview-card__header">
									<span class="request-preview-card__header-title"><?= $arResult["arrAnswersSID"][$arItem["ID"]]["TASK_NAME"][0]["USER_TEXT"] ?></span>
									<span class="request-preview-card__header-date"><?= $arItem["TSX_0"] ?></span>
								</div>

								<div class="request-preview-card__content">
									<p>
										<?= $arResult["arrAnswersSID"][$arItem["ID"]]["TASK_DESCRIPTION"][0]["USER_TEXT"] ?>
									</p>
								</div>
								<div class="request-preview-card__footer">
									<? if ($count || $price): ?>
										<div class="request-preview-card__footer-row request-preview-card__footer-row--labels">
											<? if ($count): ?>
												<div class="label">
													<span><?= $count ?>&nbsp;шт.</span>
												</div>
											<? endif; ?>
											<? if ($price): ?>
												<div class="label">
													<span>До&nbsp;<?= $price ?>&nbsp;&#8381;</span>
												</div>
											<? endif; ?>
										</div>
									<? endif; ?>

									<div class="request-preview-card__footer-row request-preview-card__footer-row--company">
										<div class="request-preview-card__footer-company">
											<span class="request-preview-card__footer-company-name"><?= $arResult["arrAnswersSID"][$arItem["ID"]]["COMPANY_NAME"][0]["USER_TEXT"] ?></span>
											<span class="request-preview-card__footer-company-city">
												<svg width="16" height="16" role="img" aria-hidden="true" focusable="false">
													<use xlink:href="/local/templates/littleweb/_dist/sprite.svg#icon-pin"></use>
												</svg>
												<span><?= $arResult["arrAnswersSID"][$arItem["ID"]]["CITY"][0]["USER_TEXT"] ?></span>
											</span>
										</div>

										<span class="request-preview-card__footer-link">Подробнее</span>
									</div>
								</div>
							</a>
						</div>
					<? endforeach; ?>
				</div>

				<div class="swiper-btn swiper-btn--prev">
					<svg width="16" height="16" role="img" aria-hidden="true" focusable="false">
						<use xlink:href="/local/templates/littleweb/_dist/sprite.svg#icon-arrow-sm"></use>
					</svg>
				</div>
				<div class="swiper-btn swiper-btn--next">
					<svg width="16" height="16" role="img" aria-hidden="true" focusable="false">
						<use xlink:href="/local/templates/littleweb/_dist/sprite.svg#icon-arrow-sm"></use>
					</svg>
				</div>
			</div>

		</div>
	</section>

<? endif; ?>
<?
// debug($arResult["arrAnswersSID"]);
?>