<?php
$text = isset($attributes['hp-offer-block-text']) ? sanitize_text_field($attributes['hp-offer-block-text']) : t('no-text');
$link = isset($attributes['hp-offer-block-link']) ? $attributes['hp-offer-block-link'] : 'https://';
$link_text = isset($attributes['hp-offer-block-link-title']) ? sanitize_text_field($attributes['hp-offer-block-link-title']) : t('tax.button.title');
$image_url = get_template_directory_uri() . '/assets/img/laptop-offer-block-pattern.png';
?>

<div class="hp-offer-block" style="background-image: url('<?php echo $image_url; ?>');">
	<div class="hp-block hp-offer-block__warapper">
		<div class="hp-offer-block__text">
			<?php echo $text; ?>
		</div>
		<?php
		get_template_part('template-parts/components/link_button', null, [
			'text' => $link_text,
			'href' => $link,
			'class' => 'hp-button_outline',
			'icon' => file_get_contents(get_template_directory() . '/assets/icons/arrow-right.svg'),
		]);
		?>
	</div>
</div>