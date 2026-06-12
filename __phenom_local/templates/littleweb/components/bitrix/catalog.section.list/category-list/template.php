<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<? if ($arResult["SECTIONS"]): ?>
  <section class="section category-list">
    <div class="container">
      <?
      $APPLICATION->IncludeFile(
        SITE_TEMPLATE_PATH . '/include/section-header.php',
        array(
          // 'CLASS' => "visually-hidden",
          'TITLE' =>  "Популярные разделы",
          'DESCRIPTION' => $arResult["DESCRIPTION"],
          'DETAIL_LINK' => '/catalog/',
          'DETAIL_LINK_TEXT' => "Смотреть все"
        ),
        array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
      );
      ?>


      <div class="grid">
        <? foreach ($arResult["SECTIONS"] as $arSection):
          $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
          $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        ?>
          <div class="grid-item">
            <a class="category-card" href="<?= $arSection["SECTION_PAGE_URL"] ?>" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
              <span><?= $arSection["NAME"] ?></span>
              <img src="<?= $arSection["PICTURE"]["SRC"] ?>" alt="<?= $arSection["NAME"] ?>" width="200" height="60">
            </a>
          </div>

        <? endforeach; ?>
      </div>
    </div>
  </section>
<? endif; ?>