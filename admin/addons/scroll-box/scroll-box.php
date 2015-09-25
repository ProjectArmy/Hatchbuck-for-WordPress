<?php
$scrollBoxKey = 'hatchbuck_scroll-box_data';

add_action( 'admin_menu', 'scroll_box_page' );
add_action( 'admin_enqueue_scripts', 'hb_iris_color_picker' );

function scroll_box_page() {
    add_submenu_page('hatchbuck-addons',
        'Scroll Box - Settings',
        'Scroll Box - Settings',
        'read',
        'scroll-box-settings',
        'scroll_box_settings'
    );
}

function hb_iris_color_picker( ) {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script(
            'iris',
            admin_url( 'js/iris.min.js' ),
            array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
            false,
            1
    );     
    wp_enqueue_script( 'hb_scrollbox_admin_script', plugin_dir_url( __FILE__ ) . 'script/admin-script.js' );
}

function scroll_box_settings() {
    global $scrollBoxKey;
    require_once("setting.php");
}

// Apply pop up
require_once("popup-setting.php");  

?>