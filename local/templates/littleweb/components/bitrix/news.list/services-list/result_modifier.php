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
		"CODE",
		"SORT",
		"DESCRIPTION",
		"DESCRIPTION_TYPE",
		"SECTION_PAGE_URL",
		"PICTURE"
	]
);

while ($arSection = $rsSections->GetNext(false, false)) {
	$arSection["SECTION_CODE_PATH"] = $arSection["CODE"];
	$sectionUrlTemplate = !empty($arParams["SECTION_URL"])
		? $arParams["SECTION_URL"]
		: $arSection["SECTION_PAGE_URL"];

	if (!empty($sectionUrlTemplate)) {
		$arSection["SECTION_PAGE_URL"] = CIBlock::ReplaceDetailUrl(
			$sectionUrlTemplate,
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

$arSectionIds = array_keys($arResult["SERVICE_SECTIONS"]);
if (!empty($arSectionIds)) {
	$rsChildSections = CIBlockSection::GetList(
		[
			"SORT" => "ASC",
			"NAME" => "ASC",
		],
		[
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ACTIVE" => "Y",
			"GLOBAL_ACTIVE" => "Y",
			"SECTION_ID" => $arSectionIds,
		],
		false,
		[
			"ID",
			"IBLOCK_ID",
			"IBLOCK_SECTION_ID",
			"NAME",
			"CODE",
			"SORT",
			"DESCRIPTION",
			"DESCRIPTION_TYPE",
			"SECTION_PAGE_URL",
			"PICTURE",
		]
	);

	while ($arChildSection = $rsChildSections->GetNext(false, false)) {
		if (empty($arChildSection["IBLOCK_SECTION_ID"]) || !isset($arResult["SERVICE_SECTIONS"][$arChildSection["IBLOCK_SECTION_ID"]])) {
			continue;
		}

		$arChildSection["SECTION_CODE_PATH"] = trim(
			$arResult["SERVICE_SECTIONS"][$arChildSection["IBLOCK_SECTION_ID"]]["SECTION_CODE_PATH"] . "/" . $arChildSection["CODE"],
			"/"
		);

		$sectionUrlTemplate = !empty($arParams["SECTION_URL"])
			? $arParams["SECTION_URL"]
			: $arChildSection["SECTION_PAGE_URL"];

		if (!empty($sectionUrlTemplate)) {
			$arChildSection["SECTION_PAGE_URL"] = CIBlock::ReplaceDetailUrl(
				$sectionUrlTemplate,
				$arChildSection,
				false,
				"S"
			);
			$arChildSection["SECTION_PAGE_URL"] = rawurldecode($arChildSection["SECTION_PAGE_URL"]);
			$arChildSection["SECTION_PAGE_URL"] = preg_replace("#(?<!:)//+#", "/", $arChildSection["SECTION_PAGE_URL"]);
		}

		$arResult["SERVICE_SECTIONS"][$arChildSection["IBLOCK_SECTION_ID"]]["ITEMS"][] = [
			"ID" => "SECTION_" . $arChildSection["ID"],
			"TYPE" => "SECTION",
			"IBLOCK_ID" => $arChildSection["IBLOCK_ID"],
			"NAME" => $arChildSection["NAME"],
			"SORT" => $arChildSection["SORT"],
			"PREVIEW_TEXT" => $arChildSection["DESCRIPTION"],
			"PREVIEW_TEXT_TYPE" => $arChildSection["DESCRIPTION_TYPE"],
			"PREVIEW_PICTURE" => [
				"SRC" => CFile::GetPath($arChildSection["PICTURE"]),
			],
			"DETAIL_PAGE_URL" => $arChildSection["SECTION_PAGE_URL"],
			"PROPERTIES" => [],
		];
	}
}

foreach ($arResult["ITEMS"] as $arItem) {
	if (
		!empty($arItem["IBLOCK_SECTION_ID"])
		&& isset($arResult["SERVICE_SECTIONS"][$arItem["IBLOCK_SECTION_ID"]])
	) {
		$arItem["TYPE"] = "ELEMENT";
		$arResult["SERVICE_SECTIONS"][$arItem["IBLOCK_SECTION_ID"]]["ITEMS"][] = $arItem;
	}
}

foreach ($arResult["SERVICE_SECTIONS"] as &$arSection) {
	usort($arSection["ITEMS"], static function ($a, $b) {
		$sortA = isset($a["SORT"]) ? (int)$a["SORT"] : 500;
		$sortB = isset($b["SORT"]) ? (int)$b["SORT"] : 500;

		if ($sortA === $sortB) {
			return strnatcasecmp($a["NAME"], $b["NAME"]);
		}

		return ($sortA < $sortB) ? -1 : 1;
	});
}
unset($arSection);
