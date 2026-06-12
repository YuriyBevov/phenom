<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$res = [];
foreach ($arResult["SECTIONS"] as $arSection) {
  if ($arSection["UF_IS_TOP_CAT"]) {
    $res[] = $arSection;
  }
}
$arResult["SECTIONS"] = $res;
