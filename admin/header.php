<?php
wp_enqueue_script( 'itsec_modal', plugins_url(basename(dirname(dirname(__FILE__)))) . '/js/admin-modal.js', array( 'jquery' ), '', true );
require( dirname( __FILE__ ) . '/modal_marketing_help.php' );
wp_localize_script( 'itsec_modal', 'itsec_tooltip_text', array(
      'nonce'    => '',
      'messages' => $messages,
      'title'    => 'Title Modal 1',
    ));
?>
<script type="text/javascript">
  jQuery( document ).ready( function () {
    function modealLoad(){
    jQuery( '#itsec_intro_modal' ).dialog(
		{
			dialogClass   : 'wp-dialog itsec-setup-dialog',
			modal         : true,
			closeOnEscape : false,
			title         : itsec_tooltip_text.title,
			width         : '75%',
			resizable     : false,
			draggable     : false,
			close         : function ( event, ui ) {

				var data = {
					action : 'itsec_tooltip_ajax',
					module : 'close',
					nonce  : itsec_tooltip_text.nonce
				};

				//call the ajax
				jQuery.post( ajaxurl, data, function () {

					var url = window.location.href;
					console.log( url );
					url = url.substring( 0, url.lastIndexOf( "&" ) );

					window.location.replace( url );

				} );

			}


		}
	);
  }
  
    
    jQuery('.hb-tab-market-help a').click(function(){
       modealLoad();
       return false;
    }); 
    
  });
</script>

<?php if(isset($_GET['hb-mh'])): ?>
<script type="text/javascript">
  jQuery( document ).ready( function () {
    jQuery('.hb-tab-market-help a').click();
  });
</script>
<?php endif; ?>

<div id="screen-meta-links">
</div>

<?php 
  $pageName = 'Form';
  $page = 'hatchbuck-manage';
  if (isset($_GET)) {
    if ($_GET['page'] == 'hatchbuck-settings') {
      $pageName = 'Settings';
      $page = 'hatchbuck-settings';
    } elseif ($_GET['page'] == 'hatchbuck-help') {
      $pageName = 'Help';
      $page = 'hatchbuck-help';
    }
  }
?>

<div class="wrap">
  <h2><?php echo PLUGIN_NAME; ?> - <?php echo $pageName; ?></h2>

  <h2 class="nav-tab-wrapper">
    <a href="?page=hatchbuck-manage" class="nav-tab <?php echo ($page == 'hatchbuck-manage')?'nav-tab-active':''; ?>">Forms</a><a href="?page=hatchbuck-settings" class="nav-tab <?php echo ($page == 'hatchbuck-settings')?'nav-tab-active':''; ?>">Settings</a><a href="?page=hatchbuck-help" class="nav-tab <?php echo ($page == 'hatchbuck-help')?'nav-tab-active':''; ?>">Help</a>
  </h2>