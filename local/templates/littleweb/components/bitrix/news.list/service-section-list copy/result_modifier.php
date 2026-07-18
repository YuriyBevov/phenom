<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult["CURRENT_SECTION"] = [];

if (!CModule::IncludeModule("iblock") || empty($arParams["IBLOCK_ID"])) {
	return;
}

$arFilter = [
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"ACTIVE" => "Y",
];

if (!empty($arParams["PARENT_SECTION"])) {
	$arFilter["ID"] = $arParams["PARENT_SECTION"];
} elseif (!empty($arParams["PARENT_SECTION_CODE"])) {
	$arFilter["CODE"] = $arParams["PARENT_SECTION_CODE"];
} else {
	return;
}

$rsSection = CIBlockSection::GetList(
	[],
	$arFilter,
	false,
	[
		"ID",
		"NAME",
		"DESCRIPTION",
		"DESCRIPTION_TYPE",
		"PICTURE",
	]
);

if ($arSection = $rsSection->GetNext(false, false)) {
	$arResult["CURRENT_SECTION"] = $arSection;
}
