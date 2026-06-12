<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arTemplateParameters = array(
  "BASE_CARD_ANIMATE_BORDER" => array(
    "NAME" => "Включить анимацию рамки карточки",
    "TYPE" => "CHECKBOX",
    "DEFAULT" => "N",
    "PARENT" => "VISUAL",
    "SORT" => 100,
  ),
  "BASE_CARD_FILLED_BG" => array(
    "NAME" => "Использовать градиентную заливку карточки",
    "TYPE" => "CHECKBOX",
    "DEFAULT" => "N",
    "PARENT" => "VISUAL",
    "SORT" => 200,
  ),
  "BASE_CARD_PICTURE_USE_DEFAULT" => array(
    "NAME" => "Использовать изображение-заглушку в карточке, если не загружена картинка для анонса",
    "TYPE" => "CHECKBOX",
    "DEFAULT" => "N",
    "PARENT" => "VISUAL",
    "SORT" => 250,
  ),
  "BASE_CARD_USE_NUMERIC_TITLES" => array(
    "NAME" => "Использовать нумерацию в заголовках карточки",
    "TYPE" => "CHECKBOX",
    "DEFAULT" => "N",
    "PARENT" => "VISUAL",
    "SORT" => 300,
  ),

  "USE_SLIDER" => array(
    "NAME" => "Использовать слайдер",
    "TYPE" => "CHECKBOX",
    "DEFAULT" => "N",
    "PARENT" => "VISUAL",
    "SORT" => 1250,
    "REFRESH" => "Y", // Важно! Перезагружает настройки при изменении
  ),
);

if (isset($arCurrentValues['USE_SLIDER']) && $arCurrentValues['USE_SLIDER'] === 'Y') {
  $arTemplateParameters["SLIDER_TYPE"] = array(
    "NAME" => "Настройка количества слайдов",
    "TYPE" => "LIST",
    "VALUES" => array(
      "1" => "Автоматически вычислять количество слайдов",
      "2" => "Задать количество слайдов",
    ),
    "DEFAULT" => "1",
    "PARENT" => "VISUAL",
    "SORT" => 1260,
    "REFRESH" => "Y",
  );
}

if (isset($arCurrentValues['USE_SLIDER']) && $arCurrentValues['USE_SLIDER'] === 'Y') {
  if ($arCurrentValues['SLIDER_TYPE'] === '2') {
    $arTemplateParameters["SLIDES_DESKTOP_VIEW_COUNT"] = array(
      "NAME" => "Количество слайдов на десктопной версии",
      "TYPE" => "LIST",
      "VALUES" => array(
        "1" => "1",
        "2" => "2",
        "3" => "3",
        "4" => "4",
      ),
      "DEFAULT" => "3",
      "PARENT" => "VISUAL",
      "SORT" => 1260,
    );
    $arTemplateParameters["SLIDES_TABLET_VIEW_COUNT"] = array(
      "NAME" => "Количество слайдов на планшетной версии",
      "TYPE" => "LIST",
      "VALUES" => array(
        "1" => "1",
        "2" => "2",
        "3" => "3",
      ),
      "DEFAULT" => "2",
      "PARENT" => "VISUAL",
      "SORT" => 1270,

    );
    $arTemplateParameters["SLIDES_MOBILE_VIEW_COUNT"] = array(
      "NAME" => "Количество слайдов на мобильной версии",
      "TYPE" => "LIST",
      "VALUES" => array(
        "1" => "1",
        "2" => "2",
      ),
      "DEFAULT" => "1",
      "PARENT" => "VISUAL",
      "SORT" => 1280,
    );
  } else {
    $arTemplateParameters["SLIDER_SLIDE_MAX_WIDTH"] = array(
      "NAME" => "Максимальная ширина слайда(в пикселях)",
      "TYPE" => "STRING",
      "DEFAULT" => "440",
      "PARENT" => "VISUAL",
      "SORT" => 300,
    );
    $arTemplateParameters["SLIDER_SHOW_NEXT_SLIDE_PART"] = array(
      "NAME" => "Показывать начало следующего слайда",
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N",
      "PARENT" => "VISUAL",
      "SORT" => 310,
    );
  }
} else {
  $arTemplateParameters["GRID_DESKTOP_VIEW_COUNT"] = array(
    "NAME" => "Количество карточек в ряду на десктопной версии",
    "TYPE" => "LIST",
    "VALUES" => array(
      "3" => "3",
      "4" => "4",
    ),
    "DEFAULT" => "4",
    "PARENT" => "VISUAL",
    "SORT" => 280,
  );
}

$arTemplateParameters["SHOW_FORM_OPENER_BTN"] = array(
  "NAME" => "Показывать кнопку открытия формы в модальном окне",
  "TYPE" => "CHECKBOX",
  "DEFAULT" => "N",
  "PARENT" => "VISUAL",
  "SORT" => 2450,
  "REFRESH" => "Y",
);

if (isset($arCurrentValues['SHOW_FORM_OPENER_BTN']) && $arCurrentValues['SHOW_FORM_OPENER_BTN'] === 'Y') {
  $arTemplateParameters["SHOW_FORM_OPENER_TEXT"] = array(
    "NAME" => "Количество слайдов на десктопной версии",
    "TYPE" => "STRING",
    "DEFAULT" => "Заказать",
    "PARENT" => "VISUAL",
    "SORT" => 2460,
  );
  $arTemplateParameters["FORM_ID"] = array(
    "NAME" => "ID формы",
    "TYPE" => "STRING",
    "DEFAULT" => "",
    "PARENT" => "VISUAL",
    "SORT" => 2470,

  );
}
