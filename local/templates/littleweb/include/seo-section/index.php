<div class="section seo-section">
  <div class="container">
    <? $APPLICATION->IncludeFile(
      SITE_TEMPLATE_PATH . '/include/seo-section/image.php',
      array(),
      array('MODE' => 'html', 'NAME' => 'изображение блока', 'SHOW_BORDER' => true)
    ); ?>
    <div class="seo-section__content">
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
  </div>
</div>