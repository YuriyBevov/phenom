<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if ($arResult["ITEMS"]): ?>
  <section class="section crawl-line">

    <div class="container">
      <div class="section__header">
        <h2><?= $arResult["NAME"] ?></h2>
        <? if ($arResult["DESCRIPTION"]): ?>
          <p>
            <?= $arResult["DESCRIPTION"] ?>
          </p>
        <? endif; ?>
      </div>
    </div>

    <div class="container-fluid">
      <div class="crawl-line__viewport">
        <div class="crawl-line__track">
          <? foreach ($arResult["ITEMS"] as $arItem):
            registerIblockElementEditActions($this, $arItem);

          ?>
            <div class="crawl-line__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
              <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" draggable="false">
            </div>
            <div class="crawl-line__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
              <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" draggable="false">
            </div>
            <div class="crawl-line__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
              <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" draggable="false">
            </div>
            <div class="crawl-line__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
              <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" draggable="false">
            </div>
            <div class="crawl-line__item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
              <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= htmlspecialcharsbx($arItem["NAME"]) ?>" width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>" height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>" draggable="false">
            </div>

          <? endforeach; ?>
        </div>
      </div>
    </div>
  </section>
<? endif; ?>
