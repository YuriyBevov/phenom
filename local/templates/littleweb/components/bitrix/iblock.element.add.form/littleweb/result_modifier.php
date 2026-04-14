<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Группировка свойств по префиксу COMPANY_
$arResult["GROUPED_PROPERTIES"] = array(
  "REQUEST_FIELDS" => array(),
  "COMPANY_FIELDS" => array()
);
$arResult["GROUPED_PROPERTY_IDS"] = array(
  "REQUEST_FIELDS" => array(),
  "COMPANY_FIELDS" => array()
);

foreach ($arResult["PROPERTY_LIST"] as $propertyId) {
  if (
    isset($arResult["PROPERTY_LIST_FULL"][$propertyId]["CODE"]) &&
    strpos($arResult["PROPERTY_LIST_FULL"][$propertyId]["CODE"], "COMPANY_") === 0 || $propertyId === "PREVIEW_PICTURE"
  ) {
    $arResult["GROUPED_PROPERTIES"]["COMPANY_FIELDS"][$propertyId] = $arResult["PROPERTY_LIST_FULL"][$propertyId];
    $arResult["GROUPED_PROPERTY_IDS"]["COMPANY_FIELDS"][] = $propertyId;
  } else {
    $arResult["GROUPED_PROPERTIES"]["REQUEST_FIELDS"][$propertyId] = $arResult["PROPERTY_LIST_FULL"][$propertyId];
    $arResult["GROUPED_PROPERTY_IDS"]["REQUEST_FIELDS"][] = $propertyId;
  }
}

// Функция для рендеринга полей свойств
$arResult["RENDER_PROPERTIES_FUNCTION"] = function ($arrIds, $arrFields, $arResult, $arParams) {
  if (empty($arrIds)) return '';

  $output = '';

  foreach ($arrIds as $propertyID):
    $property = $arrFields[$propertyID];
    $isPropertyId = intval($propertyID) > 0;

    $output .= '<div class="add-request-form__field">';

    $output .= '<label class="add-request-form__field-title" for="' . $propertyID . '">';

    if ($isPropertyId):
      $output .= htmlspecialchars($property["NAME"]) . ':';
    else:
      $customTitle = !empty($arParams["CUSTOM_TITLE_" . $propertyID]) ? $arParams["CUSTOM_TITLE_" . $propertyID] : GetMessage("IBLOCK_FIELD_" . $propertyID);
      $output .= htmlspecialchars($customTitle) . ':';
    endif;

    if (in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):
      $output .= '<span class="starrequired">*</span>';
    endif;
    $output .= '</label>';

    $output .= '<div class="add-request-form__field-control">';

    // Обработка типа поля
    if ($isPropertyId) {
      if ($property["PROPERTY_TYPE"] == "T" && $property["ROW_COUNT"] == "1") {
        $property["PROPERTY_TYPE"] = "S";
      } elseif (($property["PROPERTY_TYPE"] == "S" || $property["PROPERTY_TYPE"] == "N") && $property["ROW_COUNT"] > "1") {
        $property["PROPERTY_TYPE"] = "T";
      }
    } elseif (($propertyID == "TAGS") && CModule::IncludeModule('search')) {
      $property["PROPERTY_TYPE"] = "TAGS";
    }

    if ($property["MULTIPLE"] == "Y") {
      $inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
      $inputNum += $property["MULTIPLE_CNT"];
    } else {
      $inputNum = 1;
    }

    if ($property["GetPublicEditHTML"])
      $INPUT_TYPE = "USER_TYPE";
    else
      $INPUT_TYPE = $property["PROPERTY_TYPE"];

    ob_start();
    switch ($INPUT_TYPE):
      case "USER_TYPE":
        for ($i = 0; $i < $inputNum; $i++):
          if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
            $value = $isPropertyId ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
            $description = $isPropertyId ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
          } elseif ($i == 0) {
            $value = !$isPropertyId ? "" : $property["DEFAULT_VALUE"];
            $description = "";
          } else {
            $value = "";
            $description = "";
          }
          echo call_user_func_array(
            $property["GetPublicEditHTML"],
            array(
              $property,
              array(
                "VALUE" => $value,
                "DESCRIPTION" => $description,
              ),
              array(
                "VALUE" => "PROPERTY[" . $propertyID . "][" . $i . "][VALUE]",
                "DESCRIPTION" => "PROPERTY[" . $propertyID . "][" . $i . "][DESCRIPTION]",
                "FORM_NAME" => "iblock_add",
              ),
            )
          );
        endfor;
        break;

      case "TAGS":
        global $APPLICATION;
        $APPLICATION->IncludeComponent(
          "bitrix:search.tags.input",
          "",
          array(
            "VALUE" => $arResult["ELEMENT"][$propertyID],
            "NAME" => "PROPERTY[" . $propertyID . "][0]",
            "TEXT" => 'size="' . $property["COL_COUNT"] . '"',
          ),
          null,
          array("HIDE_ICONS" => "Y")
        );
        break;

      case "T":
        for ($i = 0; $i < $inputNum; $i++):
          if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
            $value = $isPropertyId ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
          } elseif ($i == 0) {
            $value = $isPropertyId ? "" : $property["DEFAULT_VALUE"];
          } else {
            $value = "";
          }
?>
          <textarea id="<?= $propertyID ?>" name="PROPERTY[<?= $propertyID ?>][<?= $i ?>]"><?= htmlspecialchars($value) ?></textarea>
        <?php
        endfor;
        break;

      case "S":
      case "N":
        for ($i = 0; $i < $inputNum; $i++):
          if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
            $value = $isPropertyId ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
          } elseif ($i == 0) {
            $value = !$isPropertyId ? "" : $property["DEFAULT_VALUE"];
          } else {
            $value = "";
          }
        ?>
          <input id="<?= $propertyID ?>" type="text" name="PROPERTY[<?= $propertyID ?>][<?= $i ?>]" size="<?= $property["COL_COUNT"]; ?>" value="<?= htmlspecialchars($value) ?>" />
          <? if ($property["USER_TYPE"] == "DateTime"):
            global $APPLICATION;
            $APPLICATION->IncludeComponent(
              'bitrix:main.calendar',
              '',
              array(
                'FORM_NAME' => 'iblock_add',
                'INPUT_NAME' => "PROPERTY[" . $propertyID . "][" . $i . "]",
                'INPUT_VALUE' => $value,
              ),
              null,
              array('HIDE_ICONS' => 'Y')
            );
          ?>
            <small><?= GetMessage("IBLOCK_FORM_DATE_FORMAT") ?><?= FORMAT_DATETIME ?></small>
          <? endif; ?>
        <?php
        endfor;
        break;

      case "F":
        for ($i = 0; $i < $inputNum; $i++):
          $value = $isPropertyId ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
          $valueId = isset($arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"]) ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i;
        ?>
          <input type="hidden" name="PROPERTY[<?= $propertyID ?>][<?= $valueId ?>]" value="<?= htmlspecialchars($value) ?>" />
          <input id="<?= $propertyID ?>" type="file" size="<?= $property["COL_COUNT"] ?>" name="PROPERTY_FILE_<?= $propertyID ?>_<?= $valueId ?>" />
          <? if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value])): ?>
            <input type="checkbox" name="DELETE_FILE[<?= $propertyID ?>][<?= $valueId ?>]" id="file_delete_<?= $propertyID ?>_<?= $i ?>" value="Y" /><label for="file_delete_<?= $propertyID ?>_<?= $i ?>"><?= GetMessage("IBLOCK_FORM_FILE_DELETE") ?></label>
            <? if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"]): ?>
              <img src="<?= $arResult["ELEMENT_FILES"][$value]["SRC"] ?>" height="<?= $arResult["ELEMENT_FILES"][$value]["HEIGHT"] ?>" width="<?= $arResult["ELEMENT_FILES"][$value]["WIDTH"] ?>" border="0" />
            <? else: ?>
              <?= GetMessage("IBLOCK_FORM_FILE_NAME") ?>: <?= $arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"] ?>
              <?= GetMessage("IBLOCK_FORM_FILE_SIZE") ?>: <?= $arResult["ELEMENT_FILES"][$value]["FILE_SIZE"] ?> b
              [<a href="<?= $arResult["ELEMENT_FILES"][$value]["SRC"] ?>"><?= GetMessage("IBLOCK_FORM_FILE_DOWNLOAD") ?></a>]
            <? endif; ?>
          <? endif; ?>
          <?php
        endfor;
        break;

      case "L":
        if ($property["LIST_TYPE"] == "C")
          $type = $property["MULTIPLE"] == "Y" ? "checkbox" : "radio";
        else
          $type = $property["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

        switch ($type):
          case "checkbox":
          case "radio":
            foreach ($property["ENUM"] as $key => $arEnum) {
              $checked = false;
              if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID])) {
                  foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum) {
                    if ($arElEnum["VALUE"] == $key) {
                      $checked = true;
                      break;
                    }
                  }
                }
              } else {
                if ($arEnum["DEF"] == "Y") $checked = true;
              }
          ?>
              <input type="<?= $type ?>" name="PROPERTY[<?= $propertyID ?>]<?= $type == "checkbox" ? "[" . $key . "]" : "" ?>" value="<?= $key ?>" id="property_<?= $key ?>" <?= $checked ? " checked=\"checked\"" : "" ?> /><label for="property_<?= $key ?>"><?= htmlspecialchars($arEnum["VALUE"]) ?></label>
            <?php
            }
            break;

          case "dropdown":
          case "multiselect":
            ?>
            <select id="<?= $propertyID ?>" class="custom-select" name="PROPERTY[<?= $propertyID ?>]<?= $type == "multiselect" ? "[]\" size=\"" . $property["ROW_COUNT"] . "\" multiple=\"multiple\"" : "" ?>">
              <option value=""><? echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA") ?></option>
              <?php
              if ($isPropertyId) $sKey = "ELEMENT_PROPERTIES";
              else $sKey = "ELEMENT";

              foreach ($property["ENUM"] as $key => $arEnum) {
                $checked = false;
                if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) {
                  if (isset($arResult[$sKey][$propertyID]) && is_array($arResult[$sKey][$propertyID])) {
                    foreach ($arResult[$sKey][$propertyID] as $arElEnum) {
                      if ($key == $arElEnum["VALUE"]) {
                        $checked = true;
                        break;
                      }
                    }
                  }
                } else {
                  if ($arEnum["DEF"] == "Y") $checked = true;
                }
              ?>
                <option value="<?= $key ?>" <?= $checked ? " selected=\"selected\"" : "" ?>><?= htmlspecialchars($arEnum["VALUE"]) ?></option>
              <?php
              }
              ?>
            </select>
<?php
            break;
        endswitch;
        break;
    endswitch;
    $output .= ob_get_clean();
    $output .= '</div></div>';
  endforeach;

  return $output;
};
?>