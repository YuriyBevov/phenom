<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if ($arResult["ITEMS"]): ?>
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
			<div class="swiper-container">
				<div class="swiper --autofill">
					<div class="swiper-wrapper">
						<? foreach ($arResult["ITEMS"] as $arItem):
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>

							<div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
								<div class="request-preview-card">
									<div class="request-preview-card__header">
										<span class="request-preview-card__header-title"><?= $arItem["NAME"] ?></span>
										<span class="request-preview-card__header-date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></span>
									</div>

									<p class="request-preview-card__description">
										<?= $arItem["PREVIEW_TEXT"] ?>
									</p>

									<? if (!empty($arItem["TAGS"])): ?>
										<div class="request-preview-card__tags">
											<? $arTags = preg_split('/[ ,]+/', trim($arItem["TAGS"]));
											if (!empty($arTags)): ?>
												<? foreach ($arTags as $index => $tag): ?>
													<a href=" /search/index.php?tags=<?= urlencode($tag) ?>">
														<?= htmlspecialchars($tag) ?><?= (count($arTags) > $index + 1 ? ',' : '') ?>
													</a>
												<? endforeach; ?>
											<? endif; ?>
										</div>
									<? endif; ?>

									<div class="request-preview-card__footer">

										<? if ($arItem["PROPERTIES"]["COUNT"]["VALUE"] || $arItem["PROPERTIES"]["MAX_PRICE"]["VALUE"]): ?>
											<div class="request-preview-card__footer-row request-preview-card__footer-row--labels">
												<? if ($arItem["PROPERTIES"]["COUNT"]["VALUE"]): ?>
													<div class="label">
														<span><?= $arItem["PROPERTIES"]["COUNT"]["VALUE"] ?></span>
													</div>
												<? endif; ?>
												<? if ($arItem["PROPERTIES"]["MAX_PRICE"]["VALUE"]): ?>
													<div class="label">
														<span><?= $arItem["PROPERTIES"]["MAX_PRICE"]["VALUE"] ?></span>
													</div>
												<? endif; ?>
											</div>
										<? endif; ?>

										<div class="request-preview-card__footer-row request-preview-card__footer-row--company">
											<? if ($arItem["PROPERTIES"]["COMPANY_NAME"]["VALUE"] || $arItem["PROPERTIES"]["COMPANY_CITY"]["VALUE"]): ?>

												<div class="request-preview-card__footer-company">
													<? if ($arItem["PROPERTIES"]["COMPANY_NAME"]["VALUE"]): ?>
														<img class="request-preview-card__footer-company-logo" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PROPERTIES"]["COMPANY_NAME"]["VALUE"] ?>" width="60" height="60">
														<span class="request-preview-card__footer-company-name">
															<?= $arItem["PROPERTIES"]["COMPANY_NAME"]["VALUE"] ?>
														</span>
													<? endif; ?>
													<? if ($arItem["PROPERTIES"]["COMPANY_CITY"]["VALUE"]): ?>
														<span class="request-preview-card__footer-company-city">
															<svg width="16" height="16" role="img" aria-hidden="true" focusable="false">
																<use xlink:href="/local/templates/littleweb/_dist/sprite.svg#icon-pin"></use>
															</svg>
															<span><?= $arItem["PROPERTIES"]["COMPANY_CITY"]["VALUE"] ?></span>
														</span>
													<? endif; ?>
												</div>
											<? endif; ?>

											<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="request-preview-card__footer-link">Подробнее</a>
										</div>
									</div>
								</div>
							</div>
						<? endforeach; ?>
					</div>
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