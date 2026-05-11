<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arResult['DISPLAY_PROPERTIES_WITH_PAIRS'] = array();
$arResult['DISPLAY_PROPERTY_PAIRS'] = array();

$pairProperties = array();

foreach ($arResult['DISPLAY_PROPERTIES'] as $propertyKey => $property) {
	if (empty($property['CODE'])) {
		continue;
	}

	if (!preg_match('/^(.+)_(from|to)$/i', $property['CODE'], $matches)) {
		continue;
	}

	$pairCode = strtolower($matches[1]);
	$pairSide = strtolower($matches[2]);
	$pairIndex = $pairSide === 'from' ? 0 : 1;

	if (!isset($pairProperties[$pairCode])) {
		$pairProperties[$pairCode] = array(
			'NAME' => '',
			'CODE' => $pairCode,
			'SORT' => 0,
			'PROPERTIES' => array(),
			'PROPERTY_KEYS' => array(),
			'IS_PAIR' => true,
		);
	}

	$pairProperties[$pairCode]['PROPERTIES'][$pairIndex] = $property;
	$pairProperties[$pairCode]['PROPERTY_KEYS'][$pairIndex] = $propertyKey;

	if ($pairSide === 'from' || $pairProperties[$pairCode]['NAME'] === '') {
		$pairProperties[$pairCode]['NAME'] = $property['NAME'];
		$pairProperties[$pairCode]['SORT'] = $property['SORT'] ?? 0;
	}
}

foreach ($pairProperties as $pairCode => $pair) {
	if (!isset($pair['PROPERTIES'][0], $pair['PROPERTIES'][1])) {
		continue;
	}

	ksort($pair['PROPERTIES']);
	ksort($pair['PROPERTY_KEYS']);

	$pair['PROPERTIES'] = array_values($pair['PROPERTIES']);
	$pair['PROPERTY_KEYS'] = array_values($pair['PROPERTY_KEYS']);

	$arResult['DISPLAY_PROPERTY_PAIRS'][$pairCode] = $pair;
}

$skippedPairPropertyKeys = array();

foreach ($arResult['DISPLAY_PROPERTY_PAIRS'] as $pair) {
	foreach ($pair['PROPERTY_KEYS'] as $propertyKey) {
		$skippedPairPropertyKeys[$propertyKey] = true;
	}
}

foreach ($arResult['DISPLAY_PROPERTIES'] as $propertyKey => $property) {
	if (isset($skippedPairPropertyKeys[$propertyKey])) {
		if (empty($property['CODE']) || !preg_match('/^(.+)_from$/i', $property['CODE'], $matches)) {
			continue;
		}

		$pairCode = strtolower($matches[1]);

		if (!isset($arResult['DISPLAY_PROPERTY_PAIRS'][$pairCode])) {
			continue;
		}

		$arResult['DISPLAY_PROPERTIES_WITH_PAIRS'][$pairCode] = $arResult['DISPLAY_PROPERTY_PAIRS'][$pairCode];

		continue;
	}

	$arResult['DISPLAY_PROPERTIES_WITH_PAIRS'][$propertyKey] = $property;
}
