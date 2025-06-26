<?php
function generate_toc_from_content($content, &$modified_content = null) {
	$dom = new DOMDocument();
	libxml_use_internal_errors(true);
	$dom->loadHTML('<?xml encoding="utf-8" ?>' . $content);
	libxml_clear_errors();

	$xpath = new DOMXPath($dom);
	$headings = $xpath->query('//h2 | //h3');
	$toc = [];

	foreach ($headings as $heading) {
		$text = trim($heading->textContent);
		$slug = transliterate($text);

		$heading->setAttribute('id', $slug);

		$toc[] = [
			'text' => $text,
			'id' => $slug,
			'tag' => strtolower($heading->nodeName),
		];
	}

	$body = $dom->getElementsByTagName('body')->item(0);
	$modified_content = '';
	foreach ($body->childNodes as $child) {
		$modified_content .= $dom->saveHTML($child);
	}

	return $toc;
}
