<?php
$text = isset($args['text']) ? sanitize_text_field($args['text']) : t('no-text');
$link = isset($args['link']) ? $args['link'] : 'https://';
$link_text = isset($args['link_text']) ? sanitize_text_field($args['link_text']) : t('tax.button.title');
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