<?php 
	
	if ( ! is_user_logged_in() )
		die('You must be logged in to access this script.');
	
	if(!isset($shortCodes))
		$shortCodes = new hatchbuck_Insert_Html_TinyMCESelector();
	
	global $wpdb;


$hatchbuck_snippets_arr=$wpdb->get_results($wpdb->prepare( "SELECT id,title FROM ".$wpdb->prefix.HATCHBUCK_TABLE." WHERE status=%d  ORDER BY id DESC",1),ARRAY_A );
if(count($hatchbuck_snippets_arr)==0)
die;

if(floatval(get_bloginfo('version'))>=3.9)
{
?>
(function() {

 tinymce.PluginManager.add('<?php echo $shortCodes->buttonName; ?>', function( editor, url ) {
        editor.addButton( '<?php echo $shortCodes->buttonName; ?>', {
            title: 'Insert Form Short Code',
            type: 'menubutton',
            icon: 'icon hatchbuck-own-icon',
            menu: [
<?php foreach ($hatchbuck_snippets_arr as $key=>$val) { ?>            
            	{
            		text: '<?php echo addslashes($val['title']); ?>',
            		value: '[hatchbuck form="<?php echo addslashes($val['title']); ?>"]',
            		onclick: function() {
            			editor.insertContent(this.value());
            		}
           		},
<?php } ?>           		
           ]
        });
    });

})();
<?php } else { 

	$hatchbuck_snippets = array(
                'title'   =>'Hatchbuck',
				'url'	=> plugins_url('hatchbuck/images/logo.png'),
                'hatchbuck_snippets' => $hatchbuck_snippets_arr
            );
	?>

var tinymce_<?php echo $shortCodes->buttonName; ?> =<?php echo json_encode($hatchbuck_snippets) ?>;


(function() {
	//******* Load plugin specific language pack

	tinymce.create('tinymce.plugins.<?php echo $shortCodes->buttonName; ?>', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {

         tinymce_<?php echo $shortCodes->buttonName; ?>.insert = function(){
                if(this.v && this.v != ''){
                tinymce.execCommand('mceInsertContent', false, '[hatchbuck form="'+tinymce_<?php echo $shortCodes->buttonName; ?>.hatchbuck_snippets[this.v]['title']+'"]');
				}
            };
			
		},

		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			if(n=='<?php echo $shortCodes->buttonName; ?>'){
                var c = cm.createSplitButton('<?php echo $shortCodes->buttonName; ?>', {
                     title : tinymce_<?php echo $shortCodes->buttonName; ?>.title,
					 image :  tinymce_<?php echo $shortCodes->buttonName; ?>.url,
                     onclick : tinymce_<?php echo $shortCodes->buttonName; ?>.insert
                });

                // Add some values to the list box
              

				c.onRenderMenu.add(function(c, m){
		                 for (var id in tinymce_<?php echo $shortCodes->buttonName; ?>.hat_snippets){
                            m.add({
                                v : id,
                                title : tinymce_<?php echo $shortCodes->buttonName; ?>.hatchbuck_snippets[id]['title'],
                                onclick : tinymce_<?php echo $shortCodes->buttonName; ?>.insert
                            });
                        }
                    });


                // Return the new listbox instance
                return c;
             }
             
             return null;
		},

		
	});

	// Register plugin
	tinymce.PluginManager.add('<?php echo $shortCodes->buttonName; ?>', tinymce.plugins.<?php echo $shortCodes->buttonName; ?>);
})();

<?php } ?>