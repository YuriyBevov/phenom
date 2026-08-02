<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Политика конфиденциальности");
?>


<section class="section policy">
	<div class="container">
		<div class="page-head">
			<h1 class="page-head-title">
				<? $APPLICATION->IncludeFile(
					SITE_DIR . 'include/policy/title.php',
					array(),
					array('MODE' => 'html', 'NAME' => 'заголовок', 'SHOW_BORDER' => true)
				); ?>
			</h1>

		</div>

		<div class="content-block">
			<? $APPLICATION->IncludeFile(
				SITE_DIR . 'include/policy/content.php',
				array(),
				array('MODE' => 'html', 'NAME' => 'контент', 'SHOW_BORDER' => true)
			); ?>
		</div>
</section>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>