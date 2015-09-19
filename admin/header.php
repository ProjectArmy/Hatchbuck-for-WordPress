<?php
wp_enqueue_script( 'itsec_modal', plugins_url(basename(dirname(dirname(__FILE__)))) . '/js/admin-modal.js', array( 'jquery' ), '', true );
require( dirname( __FILE__ ) . '/modal_marketing_help.php' );
wp_localize_script( 'itsec_modal', 'itsec_tooltip_text', array(
      'nonce'    => '',
      'messages' => (isset($messages))?$messages:'',
      'title'    => 'Request Your FREE Consultation',
    ));
?>
<?php if(isset($_GET['hb-mh'])): ?>
<script type="text/javascript">
  jQuery( document ).ready( function () {
		jQuery('.hb-tab-market-help a').click(function(event){
			event.preventDefault();

			var module = jQuery( this ).attr( 'href' );
			var caller = this;

       hatchbuck_modealLoad();
       return false;
    }); 
		
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
    } elseif ($_GET['page'] == 'hatchbuck-addons' || $_GET['page'] == 'scroll-box-settings') {
      $pageName = 'Addons';
      $page = 'hatchbuck-addons';
    } elseif ($_GET['page'] == 'hatchbuck-help') {
      $pageName = 'Help';
      $page = 'hatchbuck-help';
    } elseif ($_GET['page'] == 'hatchbuck-tutorial') {
      $pageName = 'Tutorial';
      $page = 'hatchbuck-tutorial';
  }
  }
?>

<div class="wrap">
  <h2><?php echo PLUGIN_NAME; ?> - <?php echo $pageName; ?></h2>

  <h2 class="nav-tab-wrapper">
    <a href="?page=hatchbuck-manage" class="nav-tab <?php echo ($page == 'hatchbuck-manage')?'nav-tab-active':''; ?>">Forms</a>
    <a href="?page=hatchbuck-settings" class="nav-tab <?php echo ($page == 'hatchbuck-settings')?'nav-tab-active':''; ?>">Settings</a>
    <a href="?page=hatchbuck-addons" class="nav-tab <?php echo ($page == 'hatchbuck-addons')?'nav-tab-active':''; ?>">Addons</a>
    <a href="?page=hatchbuck-help" class="nav-tab <?php echo ($page == 'hatchbuck-help')?'nav-tab-active':''; ?>">Help</a>
    <a href="?page=hatchbuck-tutorial" class="nav-tab <?php echo ($page == 'hatchbuck-tutorial')?'nav-tab-active':''; ?>">Tutorial</a>
  </h2>