<?php
$book_taxonomies = [];

if (is_home() || is_archive() || is_search()) {
    $args = array(
        'taxonomy'   => 'hp_book_taxonomy',
        'depth'       => 1,
        'orderby'     => 'name',
        'order'       => 'ASC',
        'hide_empty'  => false,
        'exclude'     => [get_term_by('slug', 'out_of_tax', 'hp_book_taxonomy')->term_id],
    );

    $book_taxonomies = get_terms($args);
}

$child_taxonomies = [];

if (is_tax('hp_book_taxonomy')) {
	$current_term = get_queried_object(); // Получаем объект текущего термина

	// Если $current_term существует, получаем дочерние термины
	if ($current_term && isset($current_term->term_id)) {
			$child_taxonomies = get_terms(array(
					'taxonomy'   => 'hp_book_taxonomy',
					'parent'     => $current_term->term_id,
					'hide_empty' => false
			));
	}
}
?>


<aside class="hp-aside">
		<h2 class="hp-aside__title"><?php echo t('sidebar.book-taxonomies.title'); ?></h2>

		<?php if ($book_taxonomies && !is_tax('hp_book_taxonomy')): ?>
				<div class="hp-category-current">
						<?php get_template_part('template-parts/components/button', null, [
								'id' => "hp-category-current",
								'text' => 'Все категории',
								'aria_label' => 'Текущая категория',
						]); ?>
				</div>
				<nav id="hp-categories-nav" class="hp-categories-nav hp-categories-nav_hidden">
					<button id="hp-categories-nav-close" class="3xl:hidden cursor-pointer" type="button" aria-label="Закрыть рубрики">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7 7 10 10M7 17 17 7"/>
						</svg>
					</button>
					<ul id="hp-categories-list" class="hp-categories-list">
							<?php foreach ($book_taxonomies as $taxonomy):
									$id = $taxonomy->term_id;
									$url = get_term_link($taxonomy);
									$name = esc_html($taxonomy->name);
									?>
									<li class="hp-category-item">
											<?php get_template_part('template-parts/components/link_button', null, [
													'id' => $id,
													'href' => $url,
													'text' => $name,
													'class' => 'hp-button_gray'
											]); ?>
									</li>
							<?php endforeach; ?>
					</ul>
				</nav>
				<div class="hp-categories-nav__background hidden"></div>
				<div class="hp-category-mobile-menu-button">
					<?php get_template_part('template-parts/components/button', null, [
							'id' => "hp-category-mobile-menu-button",
							'text' => 'Категории',
							'aria_label' => 'Открыть мобильное меню категорий',
							'class' => 'hp-button_gray'
					]); ?>
				</div>
		<?php endif; ?>

		<?php if (is_tax('hp_book_taxonomy')): ?>
				<div class="hp-category-current">
						<?php if ($current_term): ?>
								<?php get_template_part('template-parts/components/button', null, [
										'id' => "hp-category-current",
										'text' => $current_term->name,
										'aria_label' => 'Текущая категория',
								]); ?>
						<?php endif; ?>
				</div>
				<nav id="hp-categories-nav" class="hp-categories-nav hp-categories-nav_hidden">
						<button id="hp-categories-nav-close" class="3xl:hidden cursor-pointer" type="button" aria-label="Закрыть рубрики">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" aria-hidden="true">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m7 7 10 10M7 17 17 7"/>
							</svg>
						</button>
						<ul id="hp-categories-list" class="hp-categories-list">
								<?php if ($child_taxonomies): ?>
										<?php foreach ($child_taxonomies as $child_taxonomy):
												$id = $child_taxonomy->term_id;
												$url = get_term_link($child_taxonomy);
												$name = esc_html($child_taxonomy->name);
												?>
												<li class="hp-category-item hp-category_child">
														<?php get_template_part('template-parts/components/link_button', null, [
																'id' => $id,
																'href' => $url,
																'text' => $name,
																'class' => 'hp-button_gray'
														]); ?>
												</li>
										<?php endforeach; ?>
								<?php endif; ?>
								<li id="hp-all-category-button" class="hp-all-category-button">
										<?php get_template_part('template-parts/components/link_button', null, [
												'id' => "hp-all-category-button",
												'href' => get_post_type_archive_link('hp_books'),
												'text' => 'Все категории',
												'class' => 'hp-button_gray'
										]); ?>
								</li>
						</ul>
				</nav>
				<div class="hp-categories-nav__background hidden"></div>
				<div class="hp-category-mobile-menu-button">
						<?php get_template_part('template-parts/components/button', null, [
								'id' => "hp-category-mobile-menu-button",
								'text' => 'Категории',
								'aria_label' => 'Открыть мобильное меню категорий',
								'class' => 'hp-button_gray'
						]); ?>
				</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
				<div id="sidebar-term">
						<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
		<?php endif; ?>
</aside>
