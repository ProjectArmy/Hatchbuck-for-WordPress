<?php
require_once( dirname( __FILE__ ) . '/admin/ajax-backlink.php' );

if (isset($_POST['action']) && $_POST['action']=='hb-screen-option') {
	return require_once( dirname( __FILE__ ) . '/admin/ajax-screen-option.php' );
}