<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
</main>

<footer class="footer">
	<div class="footer__section footer__section--main">
		<div class="container">

			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"bottom-menu",
				array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "left",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "bottom",
					"USE_EXT" => "Y",
					"COMPONENT_TEMPLATE" => "bottom-menu",
					"MENU_TITLE" => "Производителям"
				),
				false
			); ?>
			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"bottom-menu",
				array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "left",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "bottom_2",
					"USE_EXT" => "Y",
					"COMPONENT_TEMPLATE" => "bottom-menu",
					"MENU_TITLE" => "Закупщикам"
				),
				false
			); ?>
			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"bottom-menu",
				array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "left",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "bottom_3",
					"USE_EXT" => "Y",
					"COMPONENT_TEMPLATE" => "bottom-menu",
					"MENU_TITLE" => "Трейдерам"
				),
				false
			); ?>
			<? $APPLICATION->IncludeComponent(
				"bitrix:menu",
				"bottom-menu",
				array(
					"ALLOW_MULTI_SELECT" => "N",
					"CHILD_MENU_TYPE" => "left",
					"DELAY" => "N",
					"MAX_LEVEL" => "1",
					"MENU_CACHE_GET_VARS" => array(),
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"ROOT_MENU_TYPE" => "bottom_4",
					"USE_EXT" => "Y",
					"COMPONENT_TEMPLATE" => "bottom-menu",
					"MENU_TITLE" => "Агентам"
				),
				false
			); ?>
		</div>
	</div>

	<div class="footer__section footer__section--bottom">
		<div class="container">
			<a href="/privacy/">Пользовательское соглашение</a>
			<small><?= date("Y") ?> ООО “ПЭС”</small>
		</div>
	</div>
	</div>
</footer>

</body>

</html>