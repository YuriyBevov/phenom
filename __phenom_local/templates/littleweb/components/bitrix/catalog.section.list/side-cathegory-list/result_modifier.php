<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ('N' != $arParams['SHOW_PARENT_NAME'])
  $arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
  $arParams['HIDE_SECTION_NAME'] = 'N';
