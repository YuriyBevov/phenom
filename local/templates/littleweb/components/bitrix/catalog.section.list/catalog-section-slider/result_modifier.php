<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult['SECTIONS'])) {
	$arResult['SECTIONS'] = array_values(array_filter($arResult['SECTIONS'], static function ($arSection) {
		return (int)$arSection['UF_INCLUDE_IN_SECTION_SLIDER'] === 1;
	}));
	$arResult['SECTIONS_COUNT'] = count($arResult['SECTIONS']);
}
