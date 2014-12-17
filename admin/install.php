<?php

function my_plugin_redirect() {
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
				install();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	install();
}


function install(){
	
	global $wpdb;
	//global $current_user; get_currentuserinfo();
	

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
}

register_activation_hook( HATCHBUCK_PLUGIN_FILE ,'hatchbuck_network_install');

add_action('admin_init', 'my_plugin_redirect');

