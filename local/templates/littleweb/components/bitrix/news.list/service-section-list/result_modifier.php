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
} elseif (!empty($arParams["PARENT_SECTION_CODE_PATH"])) {
	$arSectionCodePath = explode("/", trim($arParams["PARENT_SECTION_CODE_PATH"], "/"));
	$arFilter["CODE"] = end($arSectionCodePath);
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
		"IBLOCK_ID",
		"NAME",
		"CODE",
		"DESCRIPTION",
		"DESCRIPTION_TYPE",
		"PICTURE",
	]
);

while ($arSection = $rsSection->GetNext(false, false)) {
	if (!empty($arParams["PARENT_SECTION_CODE_PATH"])) {
		$arNavChain = [];
		$rsNavChain = CIBlockSection::GetNavChain(
			$arSection["IBLOCK_ID"],
			$arSection["ID"],
			["CODE"]
		);

		while ($arNavSection = $rsNavChain->Fetch()) {
			$arNavChain[] = $arNavSection["CODE"];
		}

		if (implode("/", $arNavChain) !== trim($arParams["PARENT_SECTION_CODE_PATH"], "/")) {
			continue;
		}
	}

	$arResult["CURRENT_SECTION"] = $arSection;
	break;
}

if (empty($arResult["CURRENT_SECTION"]["ID"])) {
	return;
}

$currentSectionCodePath = trim($arParams["PARENT_SECTION_CODE_PATH"], "/");
if ($currentSectionCodePath === "") {
	$arCurrentNavChain = [];
	$rsCurrentNavChain = CIBlockSection::GetNavChain(
		$arResult["CURRENT_SECTION"]["IBLOCK_ID"],
		$arResult["CURRENT_SECTION"]["ID"],
		["CODE"]
	);

	while ($arCurrentNavSection = $rsCurrentNavChain->Fetch()) {
		$arCurrentNavChain[] = $arCurrentNavSection["CODE"];
	}

	$currentSectionCodePath = implode("/", $arCurrentNavChain);
}

$arSectionItems = [];
$rsSections = CIBlockSection::GetList(
	[
		"SORT" => "ASC",
		"NAME" => "ASC",
	],
	[
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
		"SECTION_ID" => $arResult["CURRENT_SECTION"]["ID"],
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

while ($arSection = $rsSections->GetNext(false, false)) {
	$arSection["SECTION_CODE_PATH"] = trim($currentSectionCodePath . "/" . $arSection["CODE"], "/");
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

	$arSectionItems[] = [
		"ID" => "SECTION_" . $arSection["ID"],
		"TYPE" => "SECTION",
		"NAME" => $arSection["NAME"],
		"SORT" => $arSection["SORT"],
		"PREVIEW_TEXT" => $arSection["DESCRIPTION"],
		"PREVIEW_TEXT_TYPE" => $arSection["DESCRIPTION_TYPE"],
		"PREVIEW_PICTURE" => [
			"SRC" => CFile::GetPath($arSection["PICTURE"]),
		],
		"DETAIL_PAGE_URL" => $arSection["SECTION_PAGE_URL"],
		"PROPERTIES" => [],
		"LINK_TEXT" => "Перейти в раздел",
	];
}

foreach ($arResult["ITEMS"] as &$arItem) {
	$arItem["TYPE"] = "ELEMENT";
	$arItem["LINK_TEXT"] = "Подробнее об услуге";
}
unset($arItem);

$arResult["ITEMS"] = array_merge($arSectionItems, $arResult["ITEMS"]);

usort($arResult["ITEMS"], static function ($a, $b) {
	$sortA = isset($a["SORT"]) ? (int)$a["SORT"] : 500;
	$sortB = isset($b["SORT"]) ? (int)$b["SORT"] : 500;

	if ($sortA === $sortB) {
		return strnatcasecmp($a["NAME"], $b["NAME"]);
	}

	return ($sortA < $sortB) ? -1 : 1;
});
