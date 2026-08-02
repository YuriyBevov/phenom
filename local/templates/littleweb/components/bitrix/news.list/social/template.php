<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["ITEMS"]): ?>
	<div class="social-block">
		<? foreach ($arResult["ITEMS"] as $arItem):
			$icon = CFile::GetPath($arItem["PROPERTIES"]["ICON"]["VALUE"]);

			registerIblockElementEditActions($this, $arItem);
		?>
			<a href="<?= $arItem["PROPERTIES"]["LINK"]["VALUE"] ?>" aria-label="<?= $arItem["NAME"] ?>" rel="noopener nofollow norefferer" target="_blank" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
				<img src="<?= $icon ?>" alt="<?= $arItem["NAME"] ?>" width="40" height="40">
			</a>
		<? endforeach; ?>
	</div>
<? endif; ?>
