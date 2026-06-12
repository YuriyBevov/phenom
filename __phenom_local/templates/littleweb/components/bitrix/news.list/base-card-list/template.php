<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
// скрипт слайдера подключается в component_epilog, чтобы избежать проблем с кэшем
?>

<? if ($arResult["ITEMS"]): ?>
  <section class="section base-card-list">
    <div class="container">
      <?
      $APPLICATION->IncludeFile(
        SITE_TEMPLATE_PATH . '/include/section-header.php',
        array(
          'TITLE' => $arResult["NAME"],
          'DESCRIPTION' => $arResult["DESCRIPTION"],
          'SHOW_SLIDER_NAVIGATION_BLOCK' => $arParams["USE_SLIDER"] ?? 'N'
        ),
        array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
      );
      ?>

      <? if ($arParams["USE_SLIDER"] === "Y"):

        if ($arParams["SLIDER_TYPE"] === "1") {
          $slideMaxWidth = ($arParams["SLIDER_SLIDE_MAX_WIDTH"] ? 'max-width:' . $arParams["SLIDER_SLIDE_MAX_WIDTH"] . 'px;' : '');
          $slideInlineStyles = 'style="' . $slideMaxWidth . '"';
        }
        $itemClass = 'class="base-card-container swiper-slide' . ($arParams["SLIDER_TYPE" === "1"] && $arParams["SLIDER_SHOW_NEXT_SLIDE_PART"] === "Y" ? ' swiper-slide--width-limited' : '' . '"');
      ?>
        <div
          class="swiper base-card-slider"
          data-slides-desktop-view-count=<?= $arParams["SLIDER_TYPE"] === '2' && $arParams["SLIDES_DESKTOP_VIEW_COUNT"] ? $arParams["SLIDES_DESKTOP_VIEW_COUNT"] : 'auto' ?>
          data-slides-tablet-view-count=<?= $arParams["SLIDER_TYPE"] === '2' && $arParams["SLIDES_TABLET_VIEW_COUNT"] ? $arParams["SLIDES_TABLET_VIEW_COUNT"] : 'auto' ?>
          data-slides-mobile-view-count=<?= $arParams["SLIDER_TYPE"] === '2' && $arParams["SLIDES_MOBILE_VIEW_COUNT"] ? $arParams["SLIDES_MOBILE_VIEW_COUNT"] : 'auto' ?>>
        <? else:
        $itemClass = 'class="base-card-container grid-item"';
        ?>
          <div class="base-card-list-container <?= $arParams["BASE_CARD_USE_NUMERIC_TITLES"] === "Y" ? '--numeric-title' : '' ?>">
          <? endif; ?>

          <div class="<?= $arParams["USE_SLIDER"] === "Y" ? 'swiper-wrapper' : 'grid' ?> <?= $arParams["USE_SLIDER"] === "N" && $arParams["GRID_DESKTOP_VIEW_COUNT"] !== "" ? 'grid--cols-' . $arParams["GRID_DESKTOP_VIEW_COUNT"] : '' ?> ">
            <? foreach ($arResult["ITEMS"] as $index => $arItem):
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
              <div
                <?= $slideInlineStyles ?>

                <?= $itemClass ?>
                id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <? $APPLICATION->IncludeComponent(
                  "bitrix:news.detail",
                  "base-card",
                  array(
                    "BASE_CARD_FILLED_BG" => $arParams["BASE_CARD_FILLED_BG"],
                    "BASE_CARD_ANIMATE_BORDER" => $arParams["BASE_CARD_ANIMATE_BORDER"],
                    "BASE_CARD_PICTURE_USE_DEFAULT" => $arParams["BASE_CARD_PICTURE_USE_DEFAULT"],
                    "BASE_CARD_USE_NUMERIC_TITLES" => $arParams["BASE_CARD_USE_NUMERIC_TITLES"],

                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "ADD_ELEMENT_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "BROWSER_TITLE" => "-",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "CHECK_DATES" => "Y",
                    "COMPONENT_TEMPLATE" => "base-card",
                    "DETAIL_URL" => $arItem["DETAIL_PAGE_URL"],
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "N",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "ELEMENT_CODE" => "",
                    "ELEMENT_ID" => $arItem["ID"],
                    "FIELD_CODE" => array(
                      0 => "PREVIEW_PICTURE",
                      1 => "DATE_ACTIVE_FROM",
                      2 => "",
                    ),
                    "IBLOCK_ID" => $arResult["ID"],
                    "IBLOCK_TYPE" => "site_content",
                    "IBLOCK_URL" => "",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "MESSAGE_404" => "",
                    "META_DESCRIPTION" => "-",
                    "META_KEYWORDS" => "-",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Страница",
                    "PROPERTY_CODE" => array(
                      0 => "",
                      1 => "READING_TIME",
                    ),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_CANONICAL_URL" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "STRICT_SECTION_CHECK" => "N",
                    "USE_PERMISSIONS" => "N",
                    "USE_SHARE" => "N",
                  ),
                  $component,
                  array("HIDE_ICONS" => $index > 0 ?? "Y")
                ); ?>
              </div>
            <? endforeach; ?>
          </div>

          </div>

          <? if ($arParams["SHOW_FORM_OPENER_BTN"] === "Y" && $arParams["FORM_ID"] !== ""): ?>
            <button class="main-btn iconed" data-form-id="<?= $arParams["FORM_ID"] ?>">
              <span><?= $arParams["SHOW_FORM_OPENER_TEXT"] ?></span>
            </button>
          <? endif; ?>
        </div>
  </section>
<? endif; ?>