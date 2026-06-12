<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
if ($arResult["ITEMS"]): ?>
	<div class="tizzers">
		<div class="container">
			<? foreach ($arResult["ITEMS"] as $arItem):
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
				<? if ($arItem["PROPERTIES"]["VALUE"]["VALUE"] && $arItem["PROPERTIES"]["NAME"]["VALUE"]): ?>
					<div class="tizzers__item">
						<strong><?= $arItem["PROPERTIES"]["VALUE"]["VALUE"] ?></strong>
						<span><?= $arItem["PROPERTIES"]["NAME"]["VALUE"] ?></span>
					</div>
				<? endif; ?>
			<? endforeach; ?>
		</div>
	</div>
<? endif; ?>