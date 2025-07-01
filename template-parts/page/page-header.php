<?php
$full_seo_title = wp_get_document_title();
$decoded_title = html_entity_decode($full_seo_title, ENT_QUOTES | ENT_HTML5, 'UTF-8');

$separator = '|';
$dash_position = mb_strpos($decoded_title, $separator, 0, 'UTF-8');

if ($dash_position !== false) {
	$page_title = mb_substr($decoded_title, 0, $dash_position, 'UTF-8');
	$page_title = trim($page_title);
} else {
	$page_title = $decoded_title;
}

ob_start();
wp_head();
$head_content = ob_get_clean();
preg_match('/<meta name="description" content="([^"]*)"/i', $head_content, $matches);

$meta_description = '';
if (isset($matches[1]) && !empty($matches[1])) {
	$meta_description = $matches[1];
}

$image_url = get_template_directory_uri() . '/assets/img/laptop-page-header-pattern.webp';
?>

<section class="hp-page-header" style="background-image: url('<?php echo $image_url; ?>');">
	<?php if (!is_search()): ?>
		<hgroup class="hp-block hp-page-header__hgroup">
			<h1 class="hp-page-header__title">
				<?php echo $page_title; ?>
			</h1>
			<p class="hp-page-header__description">
				<?php echo $meta_description; ?>
			</p>
		</hgroup>
	<?php endif; ?>

	<?php if (is_search()): ?>
		<hgroup class="hp-block hp-page-header__hgroup">
			<h1 class="hp-page-header__title">
				<?php echo t('search.result.title'); ?>
			</h1>
			<p class="hp-page-header__description">
				<?php echo t('search.result.text'); ?>: <?php echo get_search_query(); ?>
			</p>
		</hgroup>
	<?php endif; ?>

	<?php if (is_category() || is_archive() || is_home() || is_search()): ?>
		<div class="hp-block hp-page-header__search">
			<?php get_search_form(); ?>
		</div>
	<?php endif; ?>
</section>