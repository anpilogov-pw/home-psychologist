<div class="hp-footer-menu">
	<div class="hp-footer-menu__item">
		<span class="hp-footer-menu__title">
			<?php echo t('menu.footer.pages') ?>
		</span>
		<?php
		wp_nav_menu(array(
			'theme_location' => 'footer',
			'container' => 'div',
			'container_class' => 'hp-footer-menu',
			'menu_class' => 'hp-footer-menu-list',
			'fallback_cb' => false,
		));
		?>
	</div>
	<div class="hp-footer-menu__item">
		<span class="hp-footer-menu__title">
			<?php echo t('menu.footer.taxes') ?>
		</span>
		<?php
		wp_nav_menu(array(
			'theme_location' => 'footer_tax',
			'container' => 'div',
			'container_class' => 'hp-footer-menu',
			'menu_class' => 'hp-footer-menu-list',
			'fallback_cb' => false,
		));
		?>
	</div>
	<div class="hp-footer-menu__item">
		<span class="hp-footer-menu__title">
			<?php echo t('menu.footer.info') ?>
		</span>
		<?php
		wp_nav_menu(array(
			'theme_location' => 'footer_docs',
			'container' => 'div',
			'container_class' => 'hp-footer-menu',
			'menu_class' => 'hp-footer-menu-list',
			'fallback_cb' => false,
		));
		?>
	</div>
</div>