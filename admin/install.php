<?php

function hatchbuck_my_plugin_redirect() {
    if (get_option('my_plugin_do_activation_redirect', false)) {
        delete_option('my_plugin_do_activation_redirect');
        wp_redirect(admin_url('admin.php?page=hatchbuck-help'));
    }
}

function hatchbuck_network_install($networkwide) {
	global $wpdb;
	add_option('my_plugin_do_activation_redirect', true);
	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				hatchbuck_install();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	hatchbuck_install();
}


function hatchbuck_install(){
	
	global $wpdb;

	add_option('hatchbuck_limit',20);
	$queryInsertHtml = "CREATE TABLE IF NOT EXISTS  ".$wpdb->prefix.HATCHBUCK_TABLE." (
	  `id` int NOT NULL AUTO_INCREMENT,
		  `title` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
		  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
		  `short_code` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
		  `status` int NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1";
	$wpdb->query($queryInsertHtml);
  
  update_option('hatchbuck_help_script',1);
	
	//set metabox by default
	update_option('hatchbuck_addons_metabox',1);
	$postTypes = get_post_types( '', 'singular_name' );
	foreach($postTypes as $key => $postType) {
		if (in_array( $postType->labels->name,array('attachment','Revisions','Navigation Menu Items','Media'))) {
			continue;
		} 
		$option[$key] = 1;
	}
	update_option('hatchbuck_postTypeTc',$option);
}

register_activation_hook( HATCHBUCK_PLUGIN_FILE ,'hatchbuck_network_install');

add_action('admin_init', 'hatchbuck_my_plugin_redirect');