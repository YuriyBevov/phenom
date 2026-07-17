<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$portfolioFilter = $arResult["PORTFOLIO_FILTER"] ?? [];
$portfolioFilterFields = $portfolioFilter["FIELDS"] ?? [];
$portfolioFilterParams = $portfolioFilter["PARAMS"] ?? [];
$portfolioFilterHasSelected = false;
$portfolioItems = $arResult["ITEMS"] ?? [];

foreach ($portfolioFilterFields as $field) {
	if (($field["SELECTED"] ?? "") !== "") {
		$portfolioFilterHasSelected = true;
		break;
	}
}
?>

<? if (($portfolioFilter["SOURCE_ITEMS_COUNT"] ?? 0) || $portfolioItems): ?>
	<section class="section portfolio-list">
		<? if ($arParams["IS_INNER"]): ?>
			<div class="page-head<?= (CFile::GetPath($arResult["PICTURE"]) ? ' page-head--bg' : '') ?>" <?= (CFile::GetPath($arResult["PICTURE"]) ? 'style="background-image:url(' . CFile::GetPath($arResult["PICTURE"]) . ')" ' : '') ?>>
				<div class="container">
					<h1 class="page-head-title">
						<?= $arResult["NAME"] ?>
					</h1>
					<? if ($arResult["DESCRIPTION"]): ?>
						<p class="page-head-description">
							<?= $arResult["DESCRIPTION"] ?>
						</p>
					<? endif; ?>
					<button class="main-btn" data-form-id="1">Оставить заявку</button>
				</div>
			</div>

			<? if ($portfolioFilterFields): ?>
				<form class="sort-row portfolio-list__filter" method="get" action="<?= $APPLICATION->GetCurPage(false) ?>">
					<? foreach ($_GET as $key => $value):
						if (in_array($key, $portfolioFilterParams, true) || is_array($value)) {
							continue;
						}
					?>
						<input type="hidden" name="<?= htmlspecialcharsbx($key) ?>" value="<?= htmlspecialcharsbx($value) ?>">
					<? endforeach; ?>

					<div class="portfolio-list__filter-wrapper">
						<? foreach ($portfolioFilterFields as $field): ?>
							<select class="custom-select portfolio-list__filter-select" name="<?= htmlspecialcharsbx($field["PARAM"]) ?>">
								<option value=""><?= htmlspecialcharsbx($field["NAME"]) ?></option>
								<? foreach ($field["OPTIONS"] as $option): ?>
									<option value="<?= htmlspecialcharsbx($option) ?>" <?= ($field["SELECTED"] === $option ? 'selected' : '') ?>>
										<?= htmlspecialcharsbx($option) ?>
									</option>
								<? endforeach; ?>
							</select>
						<? endforeach; ?>
						<? if ($portfolioFilterHasSelected): ?>
							<a href="<?= $APPLICATION->GetCurPageParam("", $portfolioFilterParams) ?>" class="main-btn portfolio-list__filter-reset-btn" aria-label="Сбросить сортировку">
								<span>Сбросить</span>
								<svg width='16' height='16' role='img' aria-hidden='true' focusable='false'>
									<use xlink:href='<?= SITE_TEMPLATE_PATH ?>/_dist/sprite.svg#icon-cross'></use>
								</svg>
							</a>
						<? endif; ?>
					</div>

					<noscript>
						<button type="submit">Показать</button>
					</noscript>
				</form>
			<? endif; ?>
		<? endif; ?>

		<div class="container">
			<? if ($arParams["IS_LINKED"]): ?>
				<div class="section__header">
					<h2><?= ($arParams["CUSTOM_TITLE"] ? $arParams["CUSTOM_TITLE"] : $arResult["NAME"]) ?></h2>
				</div>
			<? endif; ?>

			<? if ($portfolioItems): ?>
				<div class="portfolio-list__grid">
					<? foreach ($portfolioItems as $arItem):
						$previewPicture = $arItem["PREVIEW_PICTURE"];
						$previewPictureSrc = $previewPicture["SRC"] ?? "";
						$previewPictureWidth = intval($previewPicture["WIDTH"] ?? 0);
						$previewPictureHeight = intval($previewPicture["HEIGHT"] ?? 0);

						$this->AddEditAction(
							$arItem["ID"],
							$arItem["EDIT_LINK"],
							CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
						);
						$this->AddDeleteAction(
							$arItem["ID"],
							$arItem["DELETE_LINK"],
							CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
							["CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")]
						);
					?>
						<? if ($previewPictureSrc): ?>
							<a
								class="portfolio-list__item"
								href="<?= $arItem["DETAIL_PAGE_URL"] ?>"
								id="<?= $this->GetEditAreaId($arItem["ID"]); ?>">
								<img
									src="<?= $previewPictureSrc ?>"
									alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>"
									width="<?= $previewPictureWidth ?>"
									height="<?= $previewPictureHeight ?>"
									loading="lazy">

								<span class="main-btn">Подробнее о проекте</span>
							</a>
						<? endif; ?>
					<? endforeach; ?>
				</div>
			<? else: ?>
				<p class="portfolio-list__empty">По выбранным параметрам работ не найдено.</p>
			<? endif; ?>

			<? if ($arParams["DISPLAY_BOTTOM_PAGER"] || $arParams["DISPLAY_TOP_PAGER"]): ?>
				<?= $arResult["NAV_STRING"] ?>
			<? endif; ?>
		</div>
	</section>
<? endif; ?>