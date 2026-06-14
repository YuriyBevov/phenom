<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

$reviewTextLimit = 100;
$bg = CFile::GetPath($arResult["PICTURE"]);
?>

<? if ($arResult["ITEMS"]): ?>

	<section class="section reviews-preview" style="<?= $bg ? 'background-image:url(' . $bg . ')' : '' ?>">

		<div class="container">
			<div class="section__header">
				<h2><?= $arResult["NAME"] ?></h2>

				<? if ($arResult["DESCRIPTION"]): ?>
					<p>
						<?= $arResult["DESCRIPTION"] ?>
					</p>
				<? endif; ?>
			</div>
		</div>

		<div class="container-fluid">
			<div class="swiper autofill-slider">
				<div class="swiper-wrapper">
					<? foreach ($arResult["ITEMS"] as $arItem):
						$reviewText = trim(html_entity_decode(strip_tags($arItem["PREVIEW_TEXT"]), ENT_QUOTES, SITE_CHARSET));
						$isLongReview = mb_strlen($reviewText) > $reviewTextLimit;
						$cardReviewText = $isLongReview ? mb_substr($reviewText, 0, $reviewTextLimit) . '...' : $reviewText;

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
						<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<div class="review-card">
								<div class="review-card__header">
									<strong><?= $arItem["NAME"] ?></strong>
									<? if ($arItem["PROPERTIES"]["COMPANY"]["VALUE"]): ?>
										<small><?= $arItem["PROPERTIES"]["COMPANY"]["VALUE"] ?></small>
									<? endif; ?>
									<div class="review-card__rate">
										<? for ($i = 0; $i < $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i++): ?>
											<svg class="review-card__rate-item  review-card__rate-item--filled" width="16" height="16" role="img" aria-hidden="true" focusable="false">
												<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
											</svg>
										<? endfor; ?>
										<? for ($i = $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i < 5; $i++): ?>
											<svg class="review-card__rate-item" width="16" height="16" role="img" aria-hidden="true" focusable="false">
												<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
											</svg>
										<? endfor; ?>
									</div>
								</div>
								<div class="review-card__content">
									<span><?= htmlspecialcharsbx($cardReviewText) ?></span>
									<? if ($arItem["DISPLAY_ACTIVE_FROM"]): ?>
										<small><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></small>
									<? endif; ?>
								</div>

								<? if ($isLongReview): ?>
									<button
										class="review-card__expander"
										type="button"
										data-review-popup
										data-review-text="<?= htmlspecialcharsbx($reviewText) ?>">
										<span>Читать весь отзыв</span>
									</button>
								<? endif; ?>
							</div>
						</div>
						<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<div class="review-card">
								<div class="review-card__header">
									<strong><?= $arItem["NAME"] ?></strong>
									<? if ($arItem["PROPERTIES"]["COMPANY"]["VALUE"]): ?>
										<small><?= $arItem["PROPERTIES"]["COMPANY"]["VALUE"] ?></small>
									<? endif; ?>
									<div class="review-card__rate">
										<? for ($i = 0; $i < $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i++): ?>
											<svg class="review-card__rate-item  review-card__rate-item--filled" width="16" height="16" role="img" aria-hidden="true" focusable="false">
												<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
											</svg>
										<? endfor; ?>
										<? for ($i = $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i < 5; $i++): ?>
											<svg class="review-card__rate-item" width="16" height="16" role="img" aria-hidden="true" focusable="false">
												<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
											</svg>
										<? endfor; ?>
									</div>
								</div>
								<div class="review-card__content">
									<span><?= htmlspecialcharsbx($cardReviewText) ?></span>
									<? if ($arItem["DISPLAY_ACTIVE_FROM"]): ?>
										<small><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></small>
									<? endif; ?>
								</div>

								<? if ($isLongReview): ?>
									<button
										class="review-card__expander"
										type="button"
										data-review-popup
										data-review-text="<?= htmlspecialcharsbx($reviewText) ?>">
										<span>Читать весь отзыв</span>
									</button>
								<? endif; ?>
							</div>
						</div>
						<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<div class="review-card">
								<div class="review-card__header">
									<strong><?= $arItem["NAME"] ?></strong>
									<? if ($arItem["PROPERTIES"]["COMPANY"]["VALUE"]): ?>
										<small><?= $arItem["PROPERTIES"]["COMPANY"]["VALUE"] ?></small>
									<? endif; ?>
									<div class="review-card__rate">
										<? for ($i = 0; $i < $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i++): ?>
											<svg class="review-card__rate-item  review-card__rate-item--filled" width="16" height="16" role="img" aria-hidden="true" focusable="false">
												<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
											</svg>
										<? endfor; ?>
										<? for ($i = $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i < 5; $i++): ?>
											<svg class="review-card__rate-item" width="16" height="16" role="img" aria-hidden="true" focusable="false">
												<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
											</svg>
										<? endfor; ?>
									</div>
								</div>
								<div class="review-card__content">
									<span><?= htmlspecialcharsbx($cardReviewText) ?></span>
									<? if ($arItem["DISPLAY_ACTIVE_FROM"]): ?>
										<small><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></small>
									<? endif; ?>
								</div>

								<? if ($isLongReview): ?>
									<button
										class="review-card__expander"
										type="button"
										data-review-popup
										data-review-text="<?= htmlspecialcharsbx($reviewText) ?>">
										<span>Читать весь отзыв</span>
									</button>
								<? endif; ?>
							</div>
						</div>
						<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<div class="review-card">
								<div class="review-card__header">
									<strong><?= $arItem["NAME"] ?></strong>
									<? if ($arItem["PROPERTIES"]["COMPANY"]["VALUE"]): ?>
										<small><?= $arItem["PROPERTIES"]["COMPANY"]["VALUE"] ?></small>
									<? endif; ?>
									<div class="review-card__rate">
										<? for ($i = 0; $i < $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i++): ?>
											<svg class="review-card__rate-item  review-card__rate-item--filled" width="16" height="16" role="img" aria-hidden="true" focusable="false">
												<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
											</svg>
										<? endfor; ?>
										<? for ($i = $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i < 5; $i++): ?>
											<svg class="review-card__rate-item" width="16" height="16" role="img" aria-hidden="true" focusable="false">
												<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
											</svg>
										<? endfor; ?>
									</div>
								</div>
								<div class="review-card__content">
									<span><?= htmlspecialcharsbx($cardReviewText) ?></span>
									<? if ($arItem["DISPLAY_ACTIVE_FROM"]): ?>
										<small><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></small>
									<? endif; ?>
								</div>

								<? if ($isLongReview): ?>
									<button
										class="review-card__expander"
										type="button"
										data-review-popup
										data-review-text="<?= htmlspecialcharsbx($reviewText) ?>">
										<span>Читать весь отзыв</span>
									</button>
								<? endif; ?>
							</div>
						</div>
						<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<div class="review-card">
								<div class="review-card__header">
									<strong><?= $arItem["NAME"] ?></strong>
									<? if ($arItem["PROPERTIES"]["COMPANY"]["VALUE"]): ?>
										<small><?= $arItem["PROPERTIES"]["COMPANY"]["VALUE"] ?></small>
									<? endif; ?>
									<div class="review-card__rate">
										<? for ($i = 0; $i < $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i++): ?>
											<svg class="review-card__rate-item  review-card__rate-item--filled" width="16" height="16" role="img" aria-hidden="true" focusable="false">
												<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
											</svg>
										<? endfor; ?>
										<? for ($i = $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i < 5; $i++): ?>
											<svg class="review-card__rate-item" width="16" height="16" role="img" aria-hidden="true" focusable="false">
												<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
											</svg>
										<? endfor; ?>
									</div>
								</div>
								<div class="review-card__content">
									<span><?= htmlspecialcharsbx($cardReviewText) ?></span>
									<? if ($arItem["DISPLAY_ACTIVE_FROM"]): ?>
										<small><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></small>
									<? endif; ?>
								</div>

								<? if ($isLongReview): ?>
									<button
										class="review-card__expander"
										type="button"
										data-review-popup
										data-review-text="<?= htmlspecialcharsbx($reviewText) ?>">
										<span>Читать весь отзыв</span>
									</button>
								<? endif; ?>
							</div>
						</div>
						<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<div class="review-card">
								<div class="review-card__header">
									<strong><?= $arItem["NAME"] ?></strong>
									<? if ($arItem["PROPERTIES"]["COMPANY"]["VALUE"]): ?>
										<small><?= $arItem["PROPERTIES"]["COMPANY"]["VALUE"] ?></small>
									<? endif; ?>
									<div class="review-card__rate">
										<? for ($i = 0; $i < $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i++): ?>
											<svg class="review-card__rate-item  review-card__rate-item--filled" width="16" height="16" role="img" aria-hidden="true" focusable="false">
												<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
											</svg>
										<? endfor; ?>
										<? for ($i = $arItem["PROPERTIES"]["RATE"]["VALUE"]; $i < 5; $i++): ?>
											<svg class="review-card__rate-item" width="16" height="16" role="img" aria-hidden="true" focusable="false">
												<use xlink:href="<?= SITE_TEMPLATE_PATH . '/_dist/sprite.svg#icon-star' ?>"></use>
											</svg>
										<? endfor; ?>
									</div>
								</div>
								<div class="review-card__content">
									<span><?= htmlspecialcharsbx($cardReviewText) ?></span>
									<? if ($arItem["DISPLAY_ACTIVE_FROM"]): ?>
										<small><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></small>
									<? endif; ?>
								</div>

								<? if ($isLongReview): ?>
									<button
										class="review-card__expander"
										type="button"
										data-review-popup
										data-review-text="<?= htmlspecialcharsbx($reviewText) ?>">
										<span>Читать весь отзыв</span>
									</button>
								<? endif; ?>
							</div>
						</div>
					<? endforeach; ?>
				</div>
			</div>

			<button class="main-btn" data-form-id="4">Оставить отзыв</button>
		</div>
	</section>


<? endif; ?>