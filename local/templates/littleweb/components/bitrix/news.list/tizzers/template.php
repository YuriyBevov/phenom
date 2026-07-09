<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
if ($arResult["ITEMS"]): ?>
	<div class="section tizzers">
		<div class="container">
			<? foreach ($arResult["ITEMS"] as $arItem):
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
				<? if ($arItem["CODE"]): ?>
					<a href="<?= $arItem["CODE"] ?>" class="tizzers__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
					<? else: ?>
						<div class="tizzers__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
						<? endif; ?>
						<strong><?= $arItem["NAME"] ?></strong>
						<span><?= $arItem["PREVIEW_TEXT"] ?></span>
						<? if ($arItem["CODE"]): ?>
					</a>
				<? else: ?>
		</div>
	<? endif; ?>

<? endforeach; ?>
	</div>
	</div>
<? endif; ?>