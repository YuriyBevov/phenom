<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$isIndexPage = $APPLICATION->GetCurPage(false) === '/';
if ($isIndexPage && !empty($arResult['ITEMS'])) {
  $arResult['ITEMS'] = array_values(array_filter($arResult['ITEMS'], static function ($arItem) {
    $property = $arItem['PROPERTIES']['SHOW_ON_INDEX_PAGE'] ?? $arItem['PROPERTIES']['SHOW_ON_INDEX_PAGE'] ?? null;

    return ($property["VALUE_XML_ID"] ?? null) === 'Y';
  }));
}
