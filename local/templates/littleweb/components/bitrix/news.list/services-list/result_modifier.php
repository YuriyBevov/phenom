<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult["SERVICE_SECTIONS"] = [];

if (!CModule::IncludeModule("iblock") || empty($arParams["IBLOCK_ID"])) {
	return;
}

$rsSections = CIBlockSection::GetList(
	[
		"SORT" => "ASC",
		"NAME" => "ASC",
	],
	[
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
		"DEPTH_LEVEL" => 1,
	],
	false,
	[
		"ID",
		"IBLOCK_ID",
		"NAME",
		"DESCRIPTION",
		"DESCRIPTION_TYPE",
		"SECTION_PAGE_URL",
	]
);

while ($arSection = $rsSections->GetNext(false, false)) {
	if (!empty($arSection["SECTION_PAGE_URL"])) {
		$arSection["SECTION_PAGE_URL"] = CIBlock::ReplaceDetailUrl(
			$arSection["SECTION_PAGE_URL"],
			$arSection,
			false,
			"S"
		);
		$arSection["SECTION_PAGE_URL"] = rawurldecode($arSection["SECTION_PAGE_URL"]);
		$arSection["SECTION_PAGE_URL"] = preg_replace("#(?<!:)//+#", "/", $arSection["SECTION_PAGE_URL"]);
	}

	$arSection["ITEMS"] = [];
	$arResult["SERVICE_SECTIONS"][$arSection["ID"]] = $arSection;
}

foreach ($arResult["ITEMS"] as $arItem) {
	if (
		!empty($arItem["IBLOCK_SECTION_ID"])
		&& isset($arResult["SERVICE_SECTIONS"][$arItem["IBLOCK_SECTION_ID"]])
	) {
		$arResult["SERVICE_SECTIONS"][$arItem["IBLOCK_SECTION_ID"]]["ITEMS"][] = $arItem;
	}
}
