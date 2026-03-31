<div class="swiper">
  <div class="swiper-wrapper">
    <? foreach ($arResult["ITEMS"] as $arItem):
      $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
      $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
      <div class="swiper-slide" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="brand-preview-card">
          <div class="brand-preview-card__header">
            <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="172" height="172">
          </div>
          <div class="brand-preview-card__content">
            <span class="subtitle"><?= $arItem["NAME"] ?></span>
            <span class="text"><?= $arItem["PREVIEW_TEXT"] ?></span>
          </div>
        </a>
      </div>
    <? endforeach; ?>
  </div>
</div>