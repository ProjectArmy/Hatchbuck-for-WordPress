<?php 
global $wpdb;

add_shortcode('hatchbuck','hatchbuck_display_content');		

function hatchbuck_display_content($hatchbuck_snippet_name){
	global $wpdb;

	if(is_array($hatchbuck_snippet_name)){
		$snippet_name = $hatchbuck_snippet_name['form'];
		$query = $wpdb->get_results($wpdb->prepare( "SELECT * FROM ".$wpdb->prefix.HATCHBUCK_TABLE." WHERE title=%s" ,$snippet_name));
		
		if(count($query)>0){
			
			foreach ($query as $sippetdetails){
// 				return stripslashes($sippetdetails->content);
			if($sippetdetails->status==1)
				return do_shortcode($sippetdetails->content) ;
			else 
				return '';
				break;
			}
			
		}else{

			return '';
/*			return "<div style='padding:20px; font-size:16px; color:#FA5A6A; width:93%;text-align:center;background:lightyellow;border:1px solid #3FAFE3; margin:20px 0 20px 0'>
			
			Please use a valid short code to call snippet.
			
			
			</div>";
*/			
		}
		
	}
}


add_filter('widget_text', 'do_shortcode'); // to run shortcodes in text widgets