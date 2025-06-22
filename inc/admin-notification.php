<?php

add_action('admin_footer', function () {
    echo '<div id="hp-books-notice" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; display: none; background: #007cba; color: white; padding: 10px 20px; border-radius: 5px; box-shadow: 0 2px 6px rgba(0,0,0,0.2); font-size: 14px;"></div>';
});