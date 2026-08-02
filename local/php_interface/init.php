<?php


use Bitrix\Main\EventManager;


require_once $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/classes/ViteManifest.php';


global $vite;
$vite = new ViteManifest('littleweb');


$includesPath = $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/includes/';
require_once $includesPath . 'assets.php';
require_once $includesPath . 'core.php';
require_once $includesPath . 'debug.php';









