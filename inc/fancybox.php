<?php

function enqueue_fancybox() {
    wp_enqueue_style(
        'fancybox-css',
        get_template_directory_uri() . '/assets/js/lib/fancybox/fancybox.css',
        [],
        '6.0.5'
    );

    wp_enqueue_script(
        'fancybox-js',
        get_template_directory_uri() . '/assets/js/lib/fancybox/fancybox.umd.js',
        [],
        '6.0.5',
        true
    );
}

add_action('wp_enqueue_scripts', 'enqueue_fancybox');


function enqueue_fancybox_init() {
    wp_enqueue_script(
        'fancybox-init',
        get_template_directory_uri() . '/assets/js/fancybox-init.js',
        ['fancybox-js'],
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_fancybox_init');