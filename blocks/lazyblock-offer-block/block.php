<?php
$text = isset($attributes['hp-offer-block-text']) ? sanitize_text_field($attributes['hp-offer-block-text']) : t('no-text');
$link = isset($attributes['hp-offer-block-link']) ? $attributes['hp-offer-block-link'] : 'https://';
$link_text = isset($attributes['hp-offer-block-link-title']) ? sanitize_text_field($attributes['hp-offer-block-link-title']) : t('tax.button.title');
$image_url = get_template_directory_uri() . '/assets/img/laptop-offer-block-pattern.png';
?>

<?php
get_template_part('template-parts/page/page-offer-block', null, [
	'text' => $text,
	'link' => $link,
	'link_text' => $link_text,
]);
?>