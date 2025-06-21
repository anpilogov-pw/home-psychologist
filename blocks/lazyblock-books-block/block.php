<?php
$title = $attributes['hp-books-block-title'] ?? t('page.books.block.title.populars');
$link_text = $attributes['hp-books-block-link-text'] ?? t('page.books.block.link.title');
$link = $attributes['hp-books-block-link'] ?? '/knigi/';
$show_link = $attributes['hp-books-block-show-link'] ?? true;
$order = $attributes['hp-books-block-order'] ?? 'R';
$limit = $attributes['hp-books-block-limit'] ?? 6;

get_template_part('template-parts/page/page-books-block', null, [
	'title' => $title,
	'link_text' => $link_text,
	'link' => $link,
	'show_link' => $show_link,
	'order' => $order,
	'limit' => $limit
]);
?>