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

if ($arResult["SECTIONS"]):
?>
	<section class="section catalog-section-slider">
		<div class="container-fluid">

			<div class="section__header">
				<h2>Популярные разделы каталога</h2>
			</div>

			<div class="swiper autofill-slider">
				<div class="swiper-wrapper">
					<? foreach ($arResult['SECTIONS'] as &$arSection):
						$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
						$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
					?>
						<div class="swiper-slide" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
							<a href="<?= $arSection["SECTION_PAGE_URL"] ?>">
								<img src="<?= $arSection["PICTURE"]["SRC"] ?>" alt="<?= $arSection["NAME"] ?>" width="160" height="160">
								<span><?= $arSection["NAME"] ?></span>
							</a>
						</div>
					<? endforeach; ?>
				</div>

				<div class="swiper-pagination"></div>
			</div>

			<a href="/catalog/" class="catalog-section-slider__link main-btn">
				Перейти в каталог
			</a>
		</div>
	</section>
<? endif; ?>