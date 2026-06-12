<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
	die();
}

$arTemplateParameters["DEFAULT_INPUT_SIZE"] = array(
	"PARENT" => "PARAMS",
	"NAME" => GetMessage("IBLOCK_DEFAULT_INPUT_SIZE"),
	"TYPE" => "TEXT",
	"DEFAULT" => 30,
	"HIDDEN" => "Y"
);

$arTemplateParameters["PREVIEW_TEXT_USE_HTML_EDITOR"] = array(
	"PARENT" => "ACCESS",
	"NAME" => GetMessage("CP_BIEAF_PREVIEW_TEXT_USE_HTML_EDITOR"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
	"HIDDEN" => "Y"
);

$arTemplateParameters["DETAIL_TEXT_USE_HTML_EDITOR"] = array(
	"PARENT" => "ACCESS",
	"NAME" => GetMessage("CP_BIEAF_DETAIL_TEXT_USE_HTML_EDITOR"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
	"HIDDEN" => "Y"
);
