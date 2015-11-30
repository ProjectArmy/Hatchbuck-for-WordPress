<?php

if(get_option('hatchbuck_addons_form-widget')) {
    require( dirname( __FILE__ ) . '/form-widget/from-widget.php' );
}

if($data = get_option('hatchbuck_addons_scroll-box')) {
    if (wp_is_mobile() && isset($data['hb_show_mobile']) && $data['hb_show_mobile'] == 0) return;
    require( dirname( __FILE__ ) . '/scroll-box/scroll-box.php' );
}