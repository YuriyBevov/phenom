<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<? if ($arResult["ITEMS"]): ?>
	<section class="section catalog-top">
		<div class="container">
			<?
			$APPLICATION->IncludeFile(
				SITE_TEMPLATE_PATH . '/include/section-header.php',
				array(
					'TITLE' =>  "Популярные товары",
					'DESCRIPTION' => $arResult["DESCRIPTION"],
					'DETAIL_LINK' => "/catalog/",
					'DETAIL_LINK_TEXT' => "Смотреть все"
				),
				array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
			);
			?>

			<div class="grid">

				<? foreach ($arResult["ITEMS"] as $arItem):
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					// debug($arItem);

					$price = (float)($arItem["PROPERTIES"]["PRICE"]["VALUE"] ?? 0);
					$discountPercent = min(99, max(0, (float)($arItem["PROPERTIES"]["DISCOUNT"]["VALUE"] ?? 0)));
					$finalPrice = max(0, $price - $price * ($discountPercent / 100));
					$economy = $price - $finalPrice;
					$hasDiscount = ($discountPercent > 0 && $finalPrice > 0 && $finalPrice < $price);
				?>

					<div class="grid-item">
						<div class="product-card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="product-card__header" title="<?= $arItem["NAME"] ?>">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="140" height="160">
							</a>

							<div class="product-card__body">

								<div class="label">
									<svg width='24' height='24' role='img' aria-hidden='true' focusable='false'>
										<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-cube'></use>
									</svg>
									<? if ($arItem["PROPERTIES"]["MIN_COUNT"]["VALUE"]): ?>
										<span><?= $arItem["PROPERTIES"]["MIN_COUNT"]["VALUE"] ?>&nbsp;шт.</span>
									<? else: ?>
										<span>120&nbsp;шт.</span>
									<? endif; ?>
								</div>

								<? if ($hasDiscount): ?>
									<div class="product-card__discount">
										<div class="label label--warning">
											<? if ($arItem["PROPERTIES"]["DISCOUNT"]["VALUE"]): ?>
												<span><?= $discountPercent ?>%</span>
											<? endif; ?>
										</div>

										<span class="product-card__price-old"><?= $price ?> ₽</span>
									</div>
								<? endif; ?>

								<span class="product-card__price">
									<? if ($arItem["PROPERTIES"]["PRICE"]["VALUE"] && $arItem["PROPERTIES"]["PRICE"]["VALUE"] > 0): ?>
										<?= $finalPrice ?> <span class="product-card__price-currency">₽</span><small> /&nbsp;за&nbsp;1&nbsp;шт.</small>
									<? else: ?>
										<span class="product-card__price-default">По запросу</span>
									<? endif; ?>
								</span>

								<a class="product-card__title" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a>
							</div>

							<div class="product-card__footer">
								<button class="main-btn" data-form-id="1">
									<span>Оформить</span>
								</button>
							</div>
						</div>
					</div>
				<? endforeach; ?>
			</div>
		</div>
	</section>
<? endif; ?>