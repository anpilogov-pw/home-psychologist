<?php

function theme_sidebars() {
    register_sidebar(array(
        'name'          => t('sidebar.categories.title'),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside class="hp-aside">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="hp-aside__title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => t('sidebar.genres.title'),
        'id'            => 'sidebar-2',
        'before_widget' => '<aside class="hp-aside">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="hp-aside__title">',
        'after_title'   => '</h2>',
    ));
}

add_action( 'widgets_init', 'theme_sidebars' );
