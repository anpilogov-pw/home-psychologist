<?php

function add_anchor_ids_to_headings($content) {
	if (empty($content)) {
		return $content;
	}

	libxml_use_internal_errors(true);
	$dom = new DOMDocument();
	$dom->loadHTML('<?xml encoding="utf-8" ?><body>' . $content . '</body>');
	libxml_clear_errors();

	$xpath = new DOMXPath($dom);
	$headings = $xpath->query('//h2 | //h3');

	$used_ids = [];

	foreach ($headings as $heading) {
		$text = trim($heading->textContent);
		$slug = transliterate($text);

		$id = $slug;
		$used_ids[] = $id;

		$heading->setAttribute('id', $id);
	}

	$body = $dom->getElementsByTagName('body')->item(0);
	$new_content = '';

	if ($body) {
		foreach ($body->childNodes as $child) {
			$new_content .= $dom->saveHTML($child);
		}
	} else {
		// fallback на случай, если body не создан
		$new_content = $dom->saveHTML();
	}

	return $new_content;
}
