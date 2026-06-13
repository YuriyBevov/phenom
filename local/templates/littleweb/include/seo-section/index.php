<div class="section seo-section">
  <div class="container">
    <div class="seo-section__grid">
      <div class="seo-section__grid-item">
        <p>
          <?
          $APPLICATION->IncludeFile(
            SITE_TEMPLATE_PATH . '/include/seo-section/description.php',
            array(),
            array('MODE' => 'html', 'NAME' => 'описание блока', 'SHOW_BORDER' => true)
          );
          ?>
        </p>
      </div>
      <div class="seo-section__grid-item">
        <? $APPLICATION->IncludeFile(
          SITE_TEMPLATE_PATH . '/include/seo-section/image.php',
          array(),
          array('MODE' => 'html', 'NAME' => 'изображение блока', 'SHOW_BORDER' => true)
        ); ?>
      </div>
    </div>
  </div>
</div>