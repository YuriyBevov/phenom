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

$curPage = $APPLICATION->GetCurDir();

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

		<ul class="accordeon">
			<?
			$intCurrentDepth = 1;
			$boolFirst = true;
			$arSections = array_values($arResult['SECTIONS']);
			foreach ($arSections as $idx => &$arSection) {
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				$hasChildren = isset($arSections[$idx + 1]) && $arSections[$idx + 1]['RELATIVE_DEPTH_LEVEL'] > $arSection['RELATIVE_DEPTH_LEVEL'];
				$isCurrent = $curPage === $arSection['SECTION_PAGE_URL'];
				$isExpanded = $hasChildren && strpos($curPage, $arSection['SECTION_PAGE_URL']) === 0;

				if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL']) {
					echo '<div class="accordeon-body"><ul>';
				} elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL']) {
					if (!$boolFirst) echo '</li>';
				} else {
					while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL']) {
						echo '</li></ul></div>';
						$intCurrentDepth--;
					}
					echo '</li>';
				}
			?>
				<li
					id="<?= $this->GetEditAreaId($arSection['ID']); ?>"
					class="accordeon-item <?= $isExpanded ? 'expanded' : '' ?>">

					<div class="accordeon-header">
						<a href="<?= $arSection['SECTION_PAGE_URL']; ?>" class="<?= $isCurrent ? 'current' : '' ?>">
							<?= $arSection['NAME']; ?><? if ($arParams['COUNT_ELEMENTS'] && $arSection['ELEMENT_CNT'] !== null): ?>&nbsp;<span>(<?= $arSection['ELEMENT_CNT']; ?>)</span>
						<? endif; ?>
						</a>
						<? if ($hasChildren): ?>
							<button type="button" class="accordeon-expander">
								<svg width='16' height='16' role='img' aria-hidden='true' focusable='false'>
									<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-arrow-sm'></use>
								</svg>
							</button>
						<? endif; ?>
					</div>
				<?
				$intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
				$boolFirst = false;
			}
			unset($arSection);
			while ($intCurrentDepth > 1) {
				echo '</li></ul></div>';
				$intCurrentDepth--;
			}
			if ($intCurrentDepth > 0) {
				echo '</li>';
			}
				?>
		</ul>
	</div>
<? endif; ?>