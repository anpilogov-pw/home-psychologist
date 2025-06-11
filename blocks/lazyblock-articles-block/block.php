<?php
$title = $attributes['hp-articles-block-title'] ?? t('page.articles.block.title.populars');
$link_text = $attributes['hp-articles-block-link-text'] ?? t('page.articles.block.link.title');
$link = $attributes['hp-articles-block-link'] ?? '/blog/';
$show_link = $attributes['hp-articles-block-show-link'] ?? true;
$order = $attributes['hp-articles-block-order'] ?? 'R';
$limit = $attributes['hp-articles-block-limit'] ?? 6;

get_template_part('template-parts/page/page-articles-block', null, [
	'title' => $title,
	'link_text' => $link_text,
	'link' => $link,
	'show_link' => $show_link,
	'order' => $order,
	'limit' => $limit
]);
?>