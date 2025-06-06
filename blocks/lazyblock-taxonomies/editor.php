<?php
$tax_type = isset($attributes['hp-tax-type']) ? sanitize_text_field($attributes['hp-tax-type']) : 'category';
$tax_count = isset($attributes['hp-tax-count']) ? intval($attributes['hp-tax-count']) : 0;
$tax_empty_hide = isset($attributes['hp-tax-hide-empty']) ? $attributes['hp-tax-hide-empty'] : false;

$tax_count = ($tax_count > 0) ? $tax_count : 5;
$uncategorized = get_term_by('slug', 'bez-rubriki', $tax_type);
$exclude_id = $uncategorized ? [$uncategorized->term_id] : [];

$terms = get_terms([
	'taxonomy' => $tax_type,
	'hide_empty' => $tax_empty_hide,
	'number' => $tax_count,
	'orderby' => 'count',
	'order' => 'DESC',
	'exclude' => $exclude_id,
]);

if (!empty($terms) && !is_wp_error($terms)):
	?>
	<ul class="hp-taxonomy-list">
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
			get_template_part('template-parts/components/button', null, [
				'text' => t('tax.button.title'),
				'type' => 'button',
			]);
			?>
		</li>
	</ul>
<?php else: ?>
	<p>Таксономии не найдены.</p>
<?php endif; ?>