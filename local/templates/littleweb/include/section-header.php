<div class="section-header">
  <div class="section-header-row">
    <h2 class="title"><?= $arParams["TITLE"] ?></h2>
    <? if ($arParams["DETAIL_LINK"] !== ""): ?>
      <a href="<?= $arParams["DETAIL_LINK"] ?>">
        <?= $arParams["DETAIL_LINK_TEXT"]  ? $arParams["DETAIL_LINK_TEXT"] : 'Смотреть все' ?>
      </a>
    <? endif; ?>
  </div>
  <? if ($arParams["DESCRIPTION"] !== ""): ?>
    <div class="section-header-row">
      <span class="text"><?= $arParams["DESCRIPTION"] ?></span>
    </div>
  <? endif; ?>

</div>