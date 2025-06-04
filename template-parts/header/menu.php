<div class="hp-header__menu">
	<?php
		wp_nav_menu(array(
			'theme_location' => 'header',
			'container' => 'nav',
			'container_class' => 'hp-nav-menu hp-nav-menu__hidden',
			'menu_class' => 'hp-menu',
			'fallback_cb' => false,
		));
	?>
	<button id="hp-menu-button" class="hp-menu-button" data-checked="false" type="button" aria-label="<?php echo t('menu.button.aria-label') ?>">
		<svg class="hp-menu-button__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
			<path fill="currentColor" fill-rule="evenodd" d="M3.75 18a.75.75 0 0 1 .75-.75h15a.75.75 0 1 1 0 1.5h-15a.75.75 0 0 1-.75-.75Zm0-6a.75.75 0 0 1 .75-.75h15a.75.75 0 1 1 0 1.5h-15a.75.75 0 0 1-.75-.75Zm0-6a.75.75 0 0 1 .75-.75h15a.75.75 0 1 1 0 1.5h-15A.75.75 0 0 1 3.75 6Z" clip-rule="evenodd"/>
		</svg>
		<svg class="hp-menu-button__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
			<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7 7 10 10M7 17 17 7"/>
		</svg>
	</button>
</div>

