<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

if (!function_exists("portfolio_list_get_request_value")) {
	function portfolio_list_get_request_value($key)
	{
		$value = $_GET[$key] ?? "";

		if (is_array($value)) {
			return "";
		}

		return trim((string)$value);
	}
}

if (!function_exists("portfolio_list_get_filter_param_name")) {
	function portfolio_list_get_filter_param_name($propertyCode)
	{
		return "portfolio_" . strtolower(preg_replace("/[^a-zA-Z0-9_]+/", "_", $propertyCode));
	}
}

if (!function_exists("portfolio_list_normalize_property_values")) {
	function portfolio_list_normalize_property_values($property)
	{
		$values = [];
		$rawValue = $property["VALUE_ENUM"] ?? $property["VALUE"] ?? "";

		if (!is_array($rawValue)) {
			$rawValue = [$rawValue];
		}

		foreach ($rawValue as $value) {
			if (is_array($value)) {
				$value = $value["TEXT"] ?? $value["VALUE"] ?? "";
			}

			$value = trim((string)$value);

			if ($value !== "") {
				$values[$value] = $value;
			}
		}

		return array_values($values);
	}
}

if (!function_exists("portfolio_list_get_item_year")) {
	function portfolio_list_get_item_year($item)
	{
		$date = trim((string)($item["ACTIVE_FROM"] ?? ""));

		if ($date === "") {
			return "";
		}

		if (function_exists("MakeTimeStamp")) {
			$timestamp = MakeTimeStamp($date);

			if ($timestamp) {
				return date("Y", $timestamp);
			}
		}

		$timestamp = strtotime($date);

		return $timestamp ? date("Y", $timestamp) : "";
	}
}

if (!function_exists("portfolio_list_item_has_value")) {
	function portfolio_list_item_has_value($values, $selectedValue)
	{
		if ($selectedValue === "") {
			return true;
		}

		return in_array($selectedValue, $values, true);
	}
}

$filterFields = [];
$filterOptions = [];
$sourceItems = [];
$yearFilterCode = "ACTIVE_YEAR";
$filterOptions[$yearFilterCode] = [];

foreach ($arResult["ITEMS"] as $item) {
	if (isset($item["ACTIVE"]) && $item["ACTIVE"] !== "Y") {
		continue;
	}

	$itemFilterValues = [];
	$itemYear = portfolio_list_get_item_year($item);

	if ($itemYear !== "") {
		$itemFilterValues[$yearFilterCode] = [$itemYear];
		$filterOptions[$yearFilterCode][$itemYear] = $itemYear;
	}

	foreach (($item["PROPERTIES"] ?? []) as $propertyCode => $property) {
		if (strpos((string)$propertyCode, "SORT_PROP") !== 0) {
			continue;
		}

		if (!isset($filterFields[$propertyCode])) {
			$filterFields[$propertyCode] = [
				"CODE" => $propertyCode,
				"NAME" => trim((string)($property["NAME"] ?? $propertyCode)),
				"PARAM" => portfolio_list_get_filter_param_name($propertyCode),
				"SELECTED" => portfolio_list_get_request_value(portfolio_list_get_filter_param_name($propertyCode)),
			];
			$filterOptions[$propertyCode] = [];
		}

		$values = portfolio_list_normalize_property_values($property);
		$itemFilterValues[$propertyCode] = $values;

		foreach ($values as $value) {
			$filterOptions[$propertyCode][$value] = $value;
		}
	}

	$item["PORTFOLIO_FILTER_VALUES"] = $itemFilterValues;
	$sourceItems[] = $item;
}

if ($filterOptions[$yearFilterCode]) {
	$filterFields[$yearFilterCode] = [
		"CODE" => $yearFilterCode,
		"NAME" => "Год",
		"PARAM" => "portfolio_year",
		"SELECTED" => portfolio_list_get_request_value("portfolio_year"),
	];
} else {
	unset($filterOptions[$yearFilterCode]);
}

foreach ($filterOptions as $propertyCode => $options) {
	if ($propertyCode === $yearFilterCode) {
		krsort($options, SORT_NATURAL);
	} else {
		natcasesort($options);
	}

	$filterOptions[$propertyCode] = array_values($options);
}

$filterFields = array_filter($filterFields, static function ($field) use ($filterOptions) {
	return !empty($filterOptions[$field["CODE"]] ?? []);
});

$arResult["PORTFOLIO_FILTER"] = [
	"FIELDS" => array_values(array_map(static function ($field) use ($filterOptions) {
		$field["OPTIONS"] = $filterOptions[$field["CODE"]] ?? [];

		return $field;
	}, $filterFields)),
	"PARAMS" => array_column($filterFields, "PARAM"),
	"SOURCE_ITEMS_COUNT" => count($sourceItems),
];

$arResult["ITEMS"] = array_values(array_filter($sourceItems, static function ($item) use ($filterFields) {
	$values = $item["PORTFOLIO_FILTER_VALUES"];

	foreach ($filterFields as $propertyCode => $field) {
		if (!portfolio_list_item_has_value($values[$propertyCode] ?? [], $field["SELECTED"])) {
			return false;
		}
	}

	return true;
}));
