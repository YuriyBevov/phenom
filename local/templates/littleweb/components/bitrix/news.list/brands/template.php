<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if ($arResult["ITEMS"]): ?>
	<section class="section brands">
		<div class="container">
			<?
			$APPLICATION->IncludeFile(
				SITE_TEMPLATE_PATH . '/include/section-header.php',
				array(
					'TITLE' =>  $arResult["NAME"],
					'DESCRIPTION' => $arResult["DESCRIPTION"],
					'DETAIL_LINK' => $arREsult["LIST_PAGE_URL"],
					'DETAIL_LINK_TEXT' => "Смотреть все"
				),
				array('MODE' => 'html', 'NAME' => 'шапку раздела', 'SHOW_BORDER' => false)
			);
			?>

			<div class="grid">
				<? foreach ($arResult["ITEMS"] as $arItem): ?>
					<div class="grid-item">
						<div class="brand-preview-card">
							<div class="brand-preview-card__header">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="172" height="172">
							</div>
							<div class="brand-preview-card__content">
								<span class="subtitle"><?= $arItem["NAME"] ?></span>
								<span class="text"><?= $arItem["PREVIEW_TEXT"] ?></span>
							</div>
						</div>
					</div>

					<!--  -->

					<div class="grid-item">
						<div class="brand-preview-card">
							<div class="brand-preview-card__header">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="172" height="172">
							</div>
							<div class="brand-preview-card__content">
								<span class="subtitle"><?= $arItem["NAME"] ?></span>
								<span class="text"><?= $arItem["PREVIEW_TEXT"] ?></span>
							</div>
						</div>
					</div>
					<div class="grid-item">
						<div class="brand-preview-card">
							<div class="brand-preview-card__header">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="172" height="172">
							</div>
							<div class="brand-preview-card__content">
								<span class="subtitle"><?= $arItem["NAME"] ?></span>
								<span class="text"><?= $arItem["PREVIEW_TEXT"] ?></span>
							</div>
						</div>
					</div>
					<div class="grid-item">
						<div class="brand-preview-card">
							<div class="brand-preview-card__header">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="172" height="172">
							</div>
							<div class="brand-preview-card__content">
								<span class="subtitle"><?= $arItem["NAME"] ?></span>
								<span class="text"><?= $arItem["PREVIEW_TEXT"] ?></span>
							</div>
						</div>
					</div>
					<div class="grid-item">
						<div class="brand-preview-card">
							<div class="brand-preview-card__header">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="172" height="172">
							</div>
							<div class="brand-preview-card__content">
								<span class="subtitle"><?= $arItem["NAME"] ?></span>
								<span class="text"><?= $arItem["PREVIEW_TEXT"] ?></span>
							</div>
						</div>
					</div>
					<div class="grid-item">
						<div class="brand-preview-card">
							<div class="brand-preview-card__header">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="172" height="172">
							</div>
							<div class="brand-preview-card__content">
								<span class="subtitle"><?= $arItem["NAME"] ?></span>
								<span class="text"><?= $arItem["PREVIEW_TEXT"] ?></span>
							</div>
						</div>
					</div>
					<div class="grid-item">
						<div class="brand-preview-card">
							<div class="brand-preview-card__header">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="172" height="172">
							</div>
							<div class="brand-preview-card__content">
								<span class="subtitle"><?= $arItem["NAME"] ?></span>
								<span class="text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse dicta dolorem ex possimus nulla cumque animi in, optio nostrum odio veniam, tempora eaque earum! Quisquam, reprehenderit ab! Sequi, adipisci enim.</span>
							</div>
						</div>
					</div>
					<div class="grid-item">
						<div class="brand-preview-card">
							<div class="brand-preview-card__header">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="172" height="172">
							</div>
							<div class="brand-preview-card__content">
								<span class="subtitle"><?= $arItem["NAME"] ?></span>
								<span class="text"><?= $arItem["PREVIEW_TEXT"] ?></span>
							</div>
						</div>
					</div>
					<div class="grid-item">
						<div class="brand-preview-card">
							<div class="brand-preview-card__header">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="172" height="172">
							</div>
							<div class="brand-preview-card__content">
								<span class="subtitle"><?= $arItem["NAME"] ?></span>
								<span class="text"><?= $arItem["PREVIEW_TEXT"] ?></span>
							</div>
						</div>
					</div>
					<div class="grid-item">
						<div class="brand-preview-card">
							<div class="brand-preview-card__header">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="172" height="172">
							</div>
							<div class="brand-preview-card__content">
								<span class="subtitle"><?= $arItem["NAME"] ?></span>
								<span class="text"><?= $arItem["PREVIEW_TEXT"] ?></span>
							</div>
						</div>
					</div>
					<div class="grid-item">
						<div class="brand-preview-card">
							<div class="brand-preview-card__header">
								<img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["NAME"] ?>" width="172" height="172">
							</div>
							<div class="brand-preview-card__content">
								<span class="subtitle"><?= $arItem["NAME"] ?></span>
								<span class="text"><?= $arItem["PREVIEW_TEXT"] ?></span>
							</div>
						</div>
					</div>
				<? endforeach; ?>
			</div>
		</div>
	</section>

<? endif; ?>