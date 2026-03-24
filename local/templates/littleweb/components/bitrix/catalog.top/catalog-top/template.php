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
									<span>д/кол-во</span>
								</div>
								<span class="product-card__price">
									1 135 000 ₽ <small>/&nbsp;за&nbsp;1&nbsp;шт.</small>
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