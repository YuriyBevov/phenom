<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("workup");
?><? $APPLICATION->IncludeComponent(
		"bitrix:form.result.list",
		"littleweb",
		array(
			"CHAIN_ITEM_LINK" => "",
			"CHAIN_ITEM_TEXT" => "",
			"EDIT_URL" => "",
			"NAME_TEMPLATE" => "",
			"NEW_URL" => "",
			"NOT_SHOW_FILTER" => array("", ""),
			"NOT_SHOW_TABLE" => array("", ""),
			"SEF_MODE" => "N",
			"SHOW_ADDITIONAL" => "N",
			"SHOW_ANSWER_VALUE" => "N",
			"SHOW_STATUS" => "Y",
			"VIEW_URL" => "",
			"WEB_FORM_ID" => "1"
		)
	); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>