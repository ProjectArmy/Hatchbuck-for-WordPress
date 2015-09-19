<?php
$scrollBoxKey = 'hatchbuck_scroll-box_data';

add_action( 'admin_menu', 'scroll_box_page' );

function scroll_box_page() {
    add_submenu_page('hatchbuck-addons',
        'Scroll Box - Settings',
        'Scroll Box - Settings',
        'read',
        'scroll-box-settings',
        'scroll_box_settings'
    );
}

function scroll_box_settings() {
    include "setting.php";    
}

// Apply pop up
include "popup-setting.php";  

?>