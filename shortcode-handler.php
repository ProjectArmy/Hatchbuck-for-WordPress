<?php 
global $wpdb;

add_shortcode('hatchbuck','hatchbuck_display_content');		

function hatchbuck_display_content($hatchbuck_snippet_name){
	global $wpdb;

	if(is_array($hatchbuck_snippet_name)){
		wp_enqueue_script('hatchbuck');
		
		$snippet_name = $hatchbuck_snippet_name['form'];
		$query = $wpdb->get_results($wpdb->prepare( "SELECT * FROM ".$wpdb->prefix.HATCHBUCK_TABLE." WHERE title=%s" ,$snippet_name));
		
		if(count($query)>0){            
            
			foreach ($query as $sippetdetails){
// 				return stripslashes($sippetdetails->content);
			if($sippetdetails->status==1) {
                add_action( 'wp_footer', 'hatchbuck_footer' );                
                return do_shortcode($sippetdetails->content) ;
            }
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

function hatchbuck_footer() {
                echo '
                <script> 
                jQuery(document).ready(function(){  
                if(window.location.href.indexOf("cnt=0") == -1) 
                { 
                    var fileref=document.createElement("script" ); 
                    fileref.setAttribute("type","text/javascript");
                    fileref.setAttribute("src", "https://app.hatchbuck.com/OnlineForm/counter.php?page=" + jQuery( "input:hidden[name=formID]").val());
                    document.getElementsByTagName("head")[0].appendChild(fileref); } 
                });
                </script>
                ';
}

add_filter('widget_text', 'do_shortcode'); // to run shortcodes in text widgets
