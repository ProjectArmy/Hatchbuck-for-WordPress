<?php 
global $wpdb;

add_shortcode('hatchbuck','hatchbuck_display_content');		

function hatchbuck_display_content($hatchbuck_snippet_name){
	global $wpdb;

	if(is_array($hatchbuck_snippet_name)){
                wp_enqueue_script('hbjs');
                
		$snippet_name = $hatchbuck_snippet_name['form'];
		$query = $wpdb->get_results($wpdb->prepare( "SELECT * FROM ".$wpdb->prefix.HATCHBUCK_TABLE." WHERE title=%s" ,$snippet_name));
		
		if(count($query)>0){            
            
			foreach ($query as $sippetdetails){

			if($sippetdetails->status==1) {
                
                return do_shortcode($sippetdetails->content) ;
            }
			else 
				return '';
				break;
			}
			
		}else{

			return '';
	
		}
		
	}
}

/******** to run shortcodes in text widgets ********/
add_filter('widget_text', 'do_shortcode');