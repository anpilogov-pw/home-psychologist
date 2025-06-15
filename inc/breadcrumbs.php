<?php
if (!defined('ABSPATH')) {
	exit;
}

add_filter('rank_math/frontend/breadcrumb/html', function ($html) {
		// Удалим внешний <nav>, если он есть
		$html = preg_replace('~<nav[^>]*class="[^"]*rank-math-breadcrumb[^"]*"[^>]*>~', '', $html);
		$html = str_replace('</nav>', '', $html);

		// Заменим <span class="separator">...</span> на SVG-сепаратор
		$html = preg_replace('~<span class="separator">.*?</span>~', '', $html);

		// Обёртка <nav><ul>
		$html = str_replace(
				'<p>',
				'<nav class="hp-block hp-breadcrumbs" aria-label="Навигация по страницам"><ul class="hp-breadcrumbs-list">',
				$html
		);
		$html = str_replace('</p>', '</ul></nav>', $html);

		// Оборачиваем <a> в <li>
		$html = preg_replace('~<a (.*?)>(.*?)</a>~', '<li><a $1><span>$2</span></a></li>', $html);

		// Последний элемент без ссылки — с заменой Page N на Страница N
		$html = preg_replace_callback(
			'~<span class="last">(.*?)</span>~',
			function ($matches) {
				$text = $matches[1];
				if (preg_match('~^Page\s+(\d+)~i', $text, $m)) {
					$text = 'Страница ' . $m[1];
				}
				return '<li><p class="hp-breadcrumb_last" title="' . esc_attr($text) . '">' . esc_html($text) . '</p></li>';
			},
			$html
		);

		return $html;
}, 10, 3);