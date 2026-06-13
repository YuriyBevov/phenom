<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>


<? if ($arResult["ITEMS"]):
	$itemsCount = count($arResult["ITEMS"]);
?>
	<section class="section services-list">
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
			<div class="services-list__grid">
				<? foreach ($arResult["ITEMS"] as $index => $arItem):
					$cardContainerClass = "services-list-card-container";
					if ($itemsCount % 2 !== 0 && $index === $itemsCount - 1) {
						$cardContainerClass .= " services-list-card-container--odd";
					}

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
					<div class="<?= $cardContainerClass ?>">
						<a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="services-list-card" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
							<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="400" height="400">
							<span><?= $arItem["NAME"] ?></span>
						</a>
					</div>
				<? endforeach; ?>
			</div>
		</div>
	</section>
<? endif; ?>