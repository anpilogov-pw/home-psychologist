<?php
$uncategorized = get_term_by('slug', 'bez-rubriki', 'category');
$exclude_id = $uncategorized ? [$uncategorized->term_id] : [];

$terms = get_terms([
	'taxonomy' => 'category',
	'hide_empty' => false,
	'number' => 10,
	'orderby' => 'count',
	'order' => 'DESC',
	'exclude' => $exclude_id,
]);
?>

<div class="hp-taxonomies-list">
	<?php if (!empty($terms) && !is_wp_error($terms)): ?>
		<ul class="hp-block hp-taxonomies-list__wrapper">
			<?php foreach ($terms as $term): ?>
				<li>
					<?php
					get_template_part('template-parts/components/link_button', null, [
						'text' => $term->name,
						'href' => get_term_link($term),
						'class' => 'hp-button_gray',
					]);
					?>
				</li>
			<?php endforeach; ?>
			<li>
				<?php
				get_template_part('template-parts/components/link_button', null, [
					'text' => t('tax.button.title'),
					'href' => '/blog/',
					'icon' => file_get_contents(get_template_directory() . '/assets/icons/arrow-right.svg'),
				]);
				?>
			</li>
		</ul>
	<?php else: ?>
		<div><?php echo t('no-tax'); ?>.</div>
	<?php endif; ?>
</div>