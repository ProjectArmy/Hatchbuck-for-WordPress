<?php
if(!function_exists('hatchbuck_trim_deep')) {
	function hatchbuck_trim_deep($value) {
		if ( is_array($value) ) {
			$value = array_map('hatchbuck_trim_deep', $value);
		} elseif ( is_object($value) ) {
			$vars = get_object_vars( $value );
			foreach ($vars as $key=>$data) {
				$value->{$key} = hatchbuck_trim_deep( $data );
			}
		} else {
			$value = trim($value);
		}

		return $value;
	}
}

function hatchbuck_side_wide() {
    echo "\n".get_option('hatchbuck_sw_code')."\n";
}
add_action('wp_footer', 'hatchbuck_side_wide');

/**
 * Adds JS/CSS to correct pages in admin and frontend
 * @param type $hook
 */
function hatchbuck_scripts($hook) {	
	if (is_admin() && ($hook == 'toplevel_page_hatchbuck-manage' || $hook == 'hatchbuck_page_hatchbuck-settings' || $hook == 'hatchbuck_page_hatchbuck-addons' || $hook == 'hatchbuck_page_hatchbuck-help' || $hook == 'admin_page_scroll-box-settings')) {
            wp_enqueue_style('hatchbuck_style', plugins_url('/css/hatchbuck_styles.css', __FILE__),'',HATCHBUCK_VERSION);
            wp_enqueue_script('ace-editor',plugins_url('js/ace/ace.js', __FILE__),'',HATCHBUCK_VERSION);
            wp_enqueue_script('hatchbuckloc',plugins_url('js/hatchbuck.js', __FILE__),'',HATCHBUCK_VERSION, true);
	}elseif(!is_admin()){
            wp_register_script( 'hbjs', plugins_url( '/js/hbjs.min.js' , __FILE__ ), array('jquery'), HATCHBUCK_VERSION, true );
        }
        
}
add_action( 'admin_enqueue_scripts', 'hatchbuck_scripts' );
add_action( 'wp_enqueue_scripts', 'hatchbuck_scripts' );

/**
 * Fix for Hatchbuck icon in the menu
 */
function hatchbuck_icon(){
if(is_admin()){
echo "<style type=\"text/css\">
li#toplevel_page_hatchbuck-manage .wp-menu-image img{
    height: auto;
    width: 15px;
    position: relative;
    bottom: 4px;
}
i.hatchbuck-own-icon {
	background-image: url('".plugins_url( 'images/logo.png', __FILE__ )."');
}
</style>\n";
        };
};
add_action('admin_head', 'hatchbuck_icon');

/**
 * Prints the box content.
 */
function hatchbuck_wpsites_meta_box_callback( $post ) {
 
// Add an nonce field so we can check for it later.
wp_nonce_field( 'wpsites_meta_box', 'wpsites_meta_box_nonce' );
 
	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
$value = get_post_meta( $post->ID, 'metabox', true );
?>
<p><label for="metabox" class="screen-reader-text"><b><?php _e( 'Hatchbuck Tracking Code', 'Hatchbuck' ); ?></b></label></p>
<p><textarea class="widefat" rows="4" cols="4" name="metabox" class="inside"><?php echo esc_textarea( get_post_meta($post->ID, 'metabox', true) ); ?></textarea></p>
<p>Copy and paste Hatchbuck's website tracking code for this page. It will be inserted before <code>&lt;\body&gt;</code> on this page only. This is legacy mode. Switch to new, site-wide mode in settings.</p>
<?php
 
}
 
/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function hatchbuck_wpsites_save_meta_box_data( $post_id ) {
 
	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */
 
// Check if our nonce is set.
if ( ! isset( $_POST['wpsites_meta_box_nonce'] ) ) {
		return;
}
 
// Verify that the nonce is valid.
if ( ! wp_verify_nonce( $_POST['wpsites_meta_box_nonce'], 'wpsites_meta_box' ) ) {
	return;
}
 
// If this is an autosave, our form has not been submitted, so we don't want to do anything.
if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
}
 
// Check the user's permissions.
if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
 
if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
}
 
} else {
 
if ( ! current_user_can( 'edit_post', $post_id ) ) {
	return;
	}
}
 
/* OK, its safe for us to save the data now. */
	
// Make sure that it is set.
if ( ! isset( $_POST['metabox'] ) ) {
		return;
}

// Sanitize user input.
$my_data = $_POST['metabox'];
 
// Update the meta field in the database.
update_post_meta( $post_id, 'metabox', $my_data );


}
add_action( 'save_post', 'hatchbuck_wpsites_save_meta_box_data' );
 
// Hook in & Display The Value Conditionally
add_action( 'loop_start', 'hatchbuck_custom_field_before_content', 5 );
 

 
function hatchbuck_custom_field_before_content() {
	if (get_option('hatchbuck_addons_metabox')) {
		add_action('wp_footer','hatchbuckCode');
	}
}
function hatchbuckCode() {
	$postType = get_post_custom_values('metabox');
  if (isset($postType)) {
    if (is_array($postType) && isset($postType[0])) {
      echo $postType[0];
    }else { 
      echo $postType;
    }
  }
}

if (get_option('hatchbuck_addons_metabox')) {
	add_action( 'add_meta_boxes', 'hatchbuck_wpsites_register_metabox' );
	function hatchbuck_wpsites_register_metabox() {
		$postTypeTcs = get_option('hatchbuck_postTypeTc');
		if ($postTypeTcs) {
			foreach($postTypeTcs as $key => $val){
				if ($val) {
					add_meta_box(
						'wpsites_sectionid',
						'Hatchbuck Website Tracking Code',
						'hatchbuck_wpsites_meta_box_callback',
						$key,
						'normal',
						'high'
					);
				}
			}
		}
	}
}