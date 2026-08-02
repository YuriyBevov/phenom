<?php
if (!function_exists('initBitrixCore')) {
  function initBitrixCore($modules = ['popup'])
  {
    $modules = is_array($modules) ? $modules : [$modules];

    $availableModules = array_intersect($modules, ['popup', 'ajax', 'date', 'fx', 'json']);

    if (!empty($availableModules)) {
      \CJSCore::Init($availableModules);
    }
  }
}

if (!function_exists('normalizeBitrixUrl')) {
  function normalizeBitrixUrl($url)
  {
    return preg_replace("#(?<!:)//+#", "/", (string)$url);
  }
}

if (!function_exists('registerIblockElementEditActions')) {
  function registerIblockElementEditActions($template, array $item)
  {
    if (empty($item['ID']) || empty($item['IBLOCK_ID'])) {
      return;
    }

    $template->AddEditAction(
      $item['ID'],
      $item['EDIT_LINK'] ?? '',
      CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT")
    );
    $template->AddDeleteAction(
      $item['ID'],
      $item['DELETE_LINK'] ?? '',
      CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"),
      ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]
    );
  }
}
