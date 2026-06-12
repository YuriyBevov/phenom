<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult["arrResults"])) {
  $filteredResults = [];
  foreach ($arResult["arrResults"] as $item) {
    if (isset($item["STATUS_ID"]) && $item["STATUS_ID"] === "1") {
      $filteredResults[] = $item;
    }
  }
  $arResult["arrResults"] = $filteredResults;
}
