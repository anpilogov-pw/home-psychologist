<?php

add_action('wp_enqueue_scripts', function () {
	wp_enqueue_script('google-fonts-preconnect', '', [], '', false);
	add_filter('script_loader_tag', function ($tag, $handle) {
		if ($handle === 'google-fonts-preconnect') {
			return
				'<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n" .
				'<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
		}
		return $tag;
	}, 10, 2);
	wp_enqueue_style(
		'google-fonts-inter',
		'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap',
		[],
		null
	);
});
