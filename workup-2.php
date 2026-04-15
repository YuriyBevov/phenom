<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("workup");
?><?$APPLICATION->IncludeComponent(
	"bitrix:search.tags.cloud",
	"",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COLOR_NEW" => "3E74E6",
		"COLOR_OLD" => "C0C0C0",
		"COLOR_TYPE" => "Y",
		"FILTER_NAME" => "",
		"FONT_MAX" => "50",
		"FONT_MIN" => "10",
		"PAGE_ELEMENTS" => "150",
		"PERIOD" => "",
		"PERIOD_NEW_TAGS" => "",
		"SHOW_CHAIN" => "Y",
		"SORT" => "NAME",
		"TAGS_INHERIT" => "Y",
		"URL_SEARCH" => "/search/index.php",
		"WIDTH" => "100%",
		"arrFILTER" => array("iblock_products"),
		"arrFILTER_iblock_products" => array("7")
	)
);?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>