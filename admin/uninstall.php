<?php 

function hatchbuck_network_uninstall($networkwide) {
	global $wpdb;

	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				hatchbuck_uninstall();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	hatchbuck_uninstall();
}

function hatchbuck_uninstall(){

global $wpdb;

delete_option("hatchbuck_limit");
delete_option('hatchbuck_postTypeTc');

/* table delete*/
$wpdb->query("DROP TABLE ".$wpdb->prefix.HATCHBUCK_TABLE);


}

register_uninstall_hook( HATCHBUCK_PLUGIN_FILE, 'hatchbuck_network_uninstall' );
?>