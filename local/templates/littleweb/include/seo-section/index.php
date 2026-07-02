<div class="section seo-section">
  <div class="container">
    <? $APPLICATION->IncludeFile(
      SITE_TEMPLATE_PATH . '/include/seo-section/image.php',
      array(),
      array('MODE' => 'html', 'NAME' => 'изображение блока', 'SHOW_BORDER' => true)
    ); ?>
    <div class="section__header">
      <h2>О нас</h2>
    </div>
    <div class="seo-section__content">
      <?
      $APPLICATION->IncludeFile(
        SITE_TEMPLATE_PATH . '/include/seo-section/description.php',
        array(),
        array('MODE' => 'html', 'NAME' => 'описание блока', 'SHOW_BORDER' => true)
      );
      ?>
    </div>
  </div>
</div>