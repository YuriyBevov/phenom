<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$curPage = $APPLICATION->GetCurPage();

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));


if ($arResult["SECTIONS_COUNT"]): ?>
	<div class="side-cathegory-list">
		<span class="subtitle">Категория</span>

		<? if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID']):
			$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		?>
			<a
				href="<?= substr($arResult['SECTION']['SECTION_PAGE_URL'], 0, -strlen($arResult['SECTION']['CODE']) - 1); ?>"
				class="side-cathegory-list-current"
				id="<?= $this->GetEditAreaId($arResult['SECTION']['ID']); ?>">

				<svg width='16' height='16' role='img' aria-hidden='true' focusable='false'>
					<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-arrow-sm'></use>
				</svg>

				<span>
					<?= (
						isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
						? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
						: $arResult['SECTION']['NAME']
					); ?>
				</span>
			</a>
		<? endif; ?>
		<ul>
			<?
			$intCurrentDepth = 1;
			$boolFirst = true;
			$arSections = array_values($arResult['SECTIONS']);
			foreach ($arSections as $idx => &$arSection) {

				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				$hasChildren = isset($arSections[$idx + 1]) && $arSections[$idx + 1]['RELATIVE_DEPTH_LEVEL'] > $arSection['RELATIVE_DEPTH_LEVEL'];

				if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL']) {
					if (0 < $intCurrentDepth)
						echo "\n", str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']), '<ul>';
				} elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL']) {
					if (!$boolFirst)
						echo '</li>';
				} else {
					while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL']) {
						echo '</li>', "\n", str_repeat("\t", $intCurrentDepth), '</ul>', "\n", str_repeat("\t", $intCurrentDepth - 1);
						$intCurrentDepth--;
					}
					echo str_repeat("\t", $intCurrentDepth - 1), '</li>';
				}

				echo (!$boolFirst ? "\n" : ''), str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
			?>
				<li id="<?= $this->GetEditAreaId($arSection['ID']); ?>">

					<? if ($hasChildren): ?>
						<div class="side-cathegory-list-item-wrapper">
							<a href="<?= $arSection["SECTION_PAGE_URL"]; ?>" <?= $curPage === $arSection["SECTION_PAGE_URL"] ? 'class="current"' : '' ?>>
								<?= $arSection["NAME"]; ?>
								<? if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null): ?>
									<span>(<?= $arSection["ELEMENT_CNT"]; ?>)</span>
								<? endif; ?>
							</a>

							<svg width='16' height='16' role='img' aria-hidden='true' focusable='false'>
								<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-arrow-sm'></use>
							</svg>
						</div>
					<? else: ?>
						<a href="<?= $arSection["SECTION_PAGE_URL"]; ?>">
							<?= $arSection["NAME"]; ?>
							<? if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null): ?>
								<span>(<?= $arSection["ELEMENT_CNT"]; ?>)</span>
							<? endif; ?>
						</a>
					<? endif; ?>
				<?
				$intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
				$boolFirst = false;
			}
			unset($arSection);
			while ($intCurrentDepth > 1) {
				echo '</li>', "\n", str_repeat("\t", $intCurrentDepth), '</ul>', "\n", str_repeat("\t", $intCurrentDepth - 1);
				$intCurrentDepth--;
			}
			if ($intCurrentDepth > 0) {
				echo '</li>', "\n";
			}
				?>
		</ul>
	</div>
<? endif; ?>