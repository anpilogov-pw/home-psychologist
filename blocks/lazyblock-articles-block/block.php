<?php
$title = $attributes['hp-articles-block-title'] ?? t('ui.button.title');
$link_text = $attributes['hp-articles-block-link-text'] ?? t('ui.button.title');
$link = $attributes['hp-articles-block-link'] ?? home_url();
$show_link = $attributes['hp-articles-block-show-link'] ?? true;
$order = $attributes['hp-articles-block-order'] ?? 'R';
$limit = $attributes['hp-articles-block-limit'] ?? 6;

get_template_part('template-parts/page/page-articles-block', null, [
	'title' => t('page.articles.block.title.populars'),
	'link_text' => t('page.articles.block.link.title'),
	'link' => '/blog/'
]);
?>