<?php

global $wpdb;
// Load the options


if($_POST){
	
$_POST = hatchbuck_trim_deep($_POST);
$_POST = stripslashes_deep($_POST);
    
  if (isset($_POST['activate']) && isset($_POST['addon'])) {
    switch ($_POST['addon']) {
      case 'form-widget':
        update_option('hatchbuck_addons_form-widget',1);
				$notice = array(
					'error' => 0,
					'message' => 'Form Widget add-on is successfully activated'
				);
        break;
			case 'gravity-form':
				if (is_plugin_active('gravityforms/gravityforms.php')) {
					update_option('hatchbuck_addons_gravity-form',1);
					$notice = array(
						'error' => 0,
						'message' => 'Gravity Form add-on is successfully activated'
					);
				} else {
					$notice = array(
						'error' => 1,
						'message' => 'Need to install and activate first the Gravity Forms plugin in order to use this add-on'
					);
				}
        break;
    }
  }
  
  if (isset($_POST['deactivate']) && isset($_POST['addon'])) {
    switch ($_POST['addon']) {
      case 'form-widget':
        update_option('hatchbuck_addons_form-widget',null);
				$notice = array(
					'error' => 0,
					'message' => 'Form Widget add-on is successfully deactivated'
				);
        break;
			case 'gravity-form':
        update_option('hatchbuck_addons_gravity-form',null);
				$notice = array(
					'error' => 0,
					'message' => 'Gravity Form add-on is successfully deactivated'
				);
        break;
    }
  }
   header('Location: admin.php?page=hatchbuck-addons&notice='.$notice['error'].'&message='.urlencode($notice['message']));
?>



<?php
}

?>

<?php if(isset($_GET['notice'])): ?>
<div class="notice <?php echo ($_GET['notice']==0)?'updated':'error'; ?> clearfix">
	<p><?php echo $_GET['message']; ?></p>
	<div class="close"></div>
</div>
<?php endif; ?>

<div id="poststuff" class="clearfix">
<div id="post-body" class="metabox-holder columns-2">

<div id="postbox-container-2" class="postbox-container">
    <div class="inside plugin-div">
      <ul class="plugin-list">
	  
        <li class="postbox">
          <h3 class="hndle"><span>Form Widget</span></h3>
          <div class="inside">
            <img src="<?php echo plugin_dir_url( __FILE__ ); ?>image/form-widget-screenshot.png"/>
            <p>This addon adds a form widget, so you can easily include your Hatchbuck forms in your sidebars or on pages with Page Builder plugin.</p>
            <div align="left">
              <form method="post">
              <?php if(get_option('hatchbuck_addons_form-widget')): ?>
                <input type="hidden" name="addon" value="form-widget"/>
                <input type="Submit" name="deactivate" class="button button-secondary button-large" value="Deactivate">
              <?php else: ?>
                <input type="hidden" name="addon" value="form-widget"/>
                <input type="Submit" name="activate" class="button button-primary button-large" value="Activate">
              <?php endif; ?>
              </form>
            </div>
          </div><!-- inside -->
        </li>
		
		<li class="postbox">
          <h3 class="hndle"><span>Gravity Form</span></h3>
          <div class="inside">
            <img src="<?php echo plugin_dir_url( __FILE__ ); ?>image/gravity-form.png"/>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer faucibus nisl leo, vitae varius urna finibus vel. Pellentesque placerat, ante vel luctus viverra, lacus est imperdiet augue, a ultrices felis nisi pretium dui.</p>
            <div align="left">
              <form method="post">
              <?php if(get_option('hatchbuck_addons_gravity-form')): ?>
                <input type="hidden" name="addon" value="gravity-form"/>
                <input type="Submit" name="deactivate" class="button button-secondary button-large" value="Deactivate">
              <?php else: ?>
                <input type="hidden" name="addon" value="gravity-form"/>
                <input type="Submit" name="activate" class="button button-primary button-large" value="Activate">
              <?php endif; ?>
              </form>
            </div>
          </div><!-- inside -->
        </li>
		
      </ul> 
  </div><!-- postbox -->
</div><!-- postbox-container-2 -->


<?php require( dirname( __FILE__ ) . '/../../sidebar.php' ); ?>

</div><!-- postbody -->
</div><!-- poststuff -->