<?php

add_action('admin_menu', 'hatchbuck_menu');
function hatchbuck_menu(){
	
	add_menu_page('hatchbuck', 'Hatchbuck', 'edit_others_posts', 'hatchbuck-manage','hatchbuck_snippets',plugins_url(basename(dirname(dirname(__FILE__))).'/images/hb-logo-icon.svg'));
        
	add_submenu_page('hatchbuck-manage', 'Forms', 'Forms', 'edit_others_posts', 'hatchbuck-manage','hatchbuck_snippets');
	add_submenu_page('hatchbuck-manage', 'Hatchbuck - Manage settings', 'Settings', 'edit_others_posts', 'hatchbuck-settings' ,'hatchbuck_settings');	
        add_submenu_page('hatchbuck-manage', 'Hatchbuck - Addons', 'Addons', 'edit_others_posts', 'hatchbuck-addons' ,'hatchbuck_addons');
	add_submenu_page('hatchbuck-manage', 'Hatchbuck - Help', 'Help', 'edit_others_posts', 'hatchbuck-help' ,'hatchbuck_help');
	
}

function hatchbuck_snippets(){
	$formflag = 0;
	if(isset($_GET['action']) && $_GET['action']=='snippet-delete' )
	{
		include(dirname( __FILE__ ) . '/snippet-delete.php');
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='snippet-edit' )
	{
		require( dirname( __FILE__ ) . '/header.php' );
		include(dirname( __FILE__ ) . '/snippet-edit.php');
		require( dirname( __FILE__ ) . '/footer.php' );
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='snippet-add' )
	{
		require( dirname( __FILE__ ) . '/header.php' );
		require( dirname( __FILE__ ) . '/snippet-add.php' );
		require( dirname( __FILE__ ) . '/footer.php' );
		$formflag=1;
	}
	if(isset($_GET['action']) && $_GET['action']=='snippet-status' )
	{
		require( dirname( __FILE__ ) . '/snippet-status.php' );
		$formflag=1;
	}
	if($formflag == 0){
		require( dirname( __FILE__ ) . '/header.php' );
		require( dirname( __FILE__ ) . '/snippets.php' );
		require( dirname( __FILE__ ) . '/footer.php' );
	}
}

function hatchbuck_settings()
{
	require( dirname( __FILE__ ) . '/header.php' );
	require( dirname( __FILE__ ) . '/settings.php' );
	require( dirname( __FILE__ ) . '/footer.php' );
	
}

function hatchbuck_addons()
{
	require( dirname( __FILE__ ) . '/header.php' );
	require( dirname( __FILE__ ) . '/addons/addons-view/addons-view.php' );
	require( dirname( __FILE__ ) . '/footer.php' );
	
}

function hatchbuck_help(){
	require( dirname( __FILE__ ) . '/header.php' );
	require( dirname( __FILE__ ) . '/about.php' );
	require( dirname( __FILE__ ) . '/footer.php' );
}

function hatchbuck_add_style_script(){

	wp_enqueue_script('jquery');
	wp_enqueue_script( 'hatchbuck_notice_script' );
        wp_enqueue_script( 'jquery-ui-tabs' );
        wp_enqueue_script( 'jquery-ui-dialog' );
        wp_enqueue_style( 'jquery-ui-tabs' );
        wp_enqueue_style( 'wp-jquery-ui-dialog' );

}
add_action('admin_enqueue_scripts', 'hatchbuck_add_style_script');
