<?php

use Bitrix\Main\Page\Asset;

if (!function_exists('includeComponentAssets')) {
  





  function includeComponentAssets($components)
  {
    global $vite;

    if (!isset($vite) || !is_object($vite)) {
      if (defined('BX_LOG')) {
        AddMessage2Log('Vite object not found in includeComponentAssets', 'vite');
      }
      return false;
    }

    $components = is_array($components) ? $components : [$components];
    $asset = Asset::getInstance();

    foreach ($components as $componentName) {
      if (empty($componentName) || !is_string($componentName)) {
        continue;
      }

      $cssPath = $vite->getComponentCss($componentName);
      $jsPath = $vite->getComponentJs($componentName);

      if ($cssPath) {
        $asset->addCss($cssPath);
      }

      if ($jsPath) {
        $asset->addJs($jsPath);
      }
    }

    return true;
  }
}

if (!function_exists('includeGlobalAssets')) {
  




  function includeGlobalAssets()
  {
    global $vite;

    if (!isset($vite) || !is_object($vite)) {
      return false;
    }

    $asset = Asset::getInstance();

    $cssFile = $vite->getTemplateCss();
    if ($cssFile) {
      $asset->addCss($cssFile);
    }

    $jsFile = $vite->getTemplateJs();
    if ($jsFile) {
      $asset->addJs($jsFile);
    }

    return true;
  }
}
