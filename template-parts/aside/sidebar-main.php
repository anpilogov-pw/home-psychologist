<?php
$categories = [];

if (is_home() || is_archive() || is_search()) {
	$args = array(
		'title_li'     => '',
		'depth'        => 1,
		'show_count'   => false,
		'orderby'      => 'name',
		'order'        => 'DESC'
	);

	$categories = get_categories($args);
}

$child_categories = [];

if (is_category()) {
	$current_category = get_queried_object();
	$child_categories = get_categories(array(
		'parent' => $current_category->term_id,
		'hide_empty' => false
	));


	$parent_id = $current_category->parent;

	if ($parent_id) {
		$parent_category = get_term($parent_id, 'category');
	}
}
?>

<aside class="hp-aside">
	<h2 class="hp-aside__title"><?php echo t('sidebar.categories.title'); ?></h2>
	<?php if ($categories && !is_category()): ?>
		<div class="hp-category-current">
			<?php get_template_part('template-parts/components/button', null, [
				'id' => "hp-category-current",
				'text' => 'Все рубрики',
				'aria_label' => 'Тукущая рубрика',
			]); ?>
		</div>
		<nav id="hp-categories-nav" class="hp-categories-nav hp-categories-nav_hidden">
			<ul id="hp-categories-list" class="hp-categories-list">
				<?php foreach ($categories as $category):
					$id = $category->term_id;
					$url = get_category_link($category);
					$name = esc_html($category->name);
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
		<div class="hp-category-mobile-menu-button">
			<?php get_template_part('template-parts/components/button', null, [
				'id' => "hp-category-mobile-menu-button",
				'text' => 'Рубрики',
				'aria_label' => 'Открыть мобильное меню рубрик',
				'class' => 'hp-button_gray'
			]); ?>
		</div>
	<?php endif; ?>

	<?php if (is_category()): ?>
		<div class="hp-category-current">
			<?php if ($current_category): ?>
				<?php get_template_part('template-parts/components/button', null, [
					'id' => "hp-category-current",
					'text' => $current_category->name,
					'aria_label' => 'Тукущая рубрика',
				]); ?>
			<?php endif; ?>
		</div>
		<nav id="hp-categories-nav" class="hp-categories-nav hp-categories-nav_hidden">
			<ul id="hp-categories-list" class="hp-categories-list">
				<?php if ($child_categories): ?>
					<?php foreach ($child_categories as $child_category):
						$id = $child_category->term_id;
						$url = get_category_link($child_category);
						$name = esc_html($child_category->name);
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
						'href' => get_permalink(get_option('page_for_posts')),
						'text' => 'Все рубрики',
						'class' => 'hp-button_gray'
					]); ?>
				</li>
			</ul>
		</nav>
		<div class="hp-category-mobile-menu-button">
			<?php get_template_part('template-parts/components/button', null, [
				'id' => "hp-category-mobile-menu-button",
				'text' => 'Рубрики',
				'aria_label' => 'Открыть мобильное меню рубрик',
				'class' => 'hp-button_gray'
			]); ?>
		</div>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="sidebar-category">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
	<?php endif; ?>
</aside>