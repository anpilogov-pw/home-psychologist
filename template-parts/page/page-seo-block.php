<?php
$show_seo_block = get_field('hp-show-seo-block', 'option');
$seo_block_title = get_field('hp-seo-block-title', 'option');
$seo_block_text = get_field('hp-seo-block-text', 'option');
$seo_block_img = get_field('hp-seo-block-img', 'option');
$show_seo_block_link = get_field('hp-show-seo-block-link', 'option');
$seo_block_link_url = get_field('hp-seo-block-link-url', 'option');
$seo_block_link_text = get_field('hp-seo-block-link-text', 'option');
?>

<?php if ($show_seo_block) : ?>
<section class="hp-seo-block" style="background: linear-gradient(270deg, rgba(0, 0, 0, 0.00) 30%, rgba(0, 0, 0, 0.70) 70%), url(<?php echo esc_url($seo_block_img); ?>) no-repeat;">
	<div class="hp-block">
		<hgroup class="hp-seo-block__hgroup">
			<h2 class="hp-seo-block__title"><?php echo esc_html($seo_block_title); ?></h2>
			<p class="hp-seo-block__text"><?php echo esc_html($seo_block_text); ?></p>
		</hgroup>
		<a class="hp-seo-block__link" href="<?php echo esc_url($seo_block_link_url) ?>" title="<?php echo esc_attr($seo_block_link_text); ?>">
			<?php echo esc_html($seo_block_link_text); ?>
		</a>
	<div>
</section>
<?php endif; ?>