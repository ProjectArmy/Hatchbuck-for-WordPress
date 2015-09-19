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
            break;
        case 'scroll-box':
            update_option('hatchbuck_addons_scroll-box',1);
            break;        
        case 'side-wide':
            update_option('hatchbuck_addons_side-wide',1);
			update_option('hatchbuck_addons_metabox',null);
            break;
		case 'metabox':
            update_option('hatchbuck_addons_metabox',1);
			update_option('hatchbuck_addons_side-wide',null);
            break;
    }      
    $noticeval = 'Activated';
  }
  
  if (isset($_POST['deactivate']) && isset($_POST['addon'])) {
    switch ($_POST['addon']) {
        case 'form-widget':
            update_option('hatchbuck_addons_form-widget',null);
            break;
        case 'scroll-box':
            update_option('hatchbuck_addons_scroll-box',null);
            break; 
        case 'side-wide':
            update_option('hatchbuck_addons_side-wide',null);
            break;
		case 'metabox':
            update_option('hatchbuck_addons_metabox',null);
            break;
    }
    $noticeval = 'Deactivated';
  }
  
  header('Location: admin.php?page=hatchbuck-addons&notice=1&noticeval='.$noticeval);
?>
<?php
}

?>

<?php if(isset($_GET['notice'])): ?>
<div class="system_notice_area_style1" id="system_notice_area">
	Addon <?php echo $_GET['noticeval']; ?> successfully. &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php endif; ?>

<div id="poststuff">
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
          <h3 class="hndle"><span>Scroll Box</span></h3>
          <div class="inside">
            <img src="<?php echo plugin_dir_url( __FILE__ ); ?>image/blank.png"/>
            <p>This addon adds a email subscribe pop up to page so users can easily add their email to keep updated. Requires Hatchbuck API key.</p>
            <div align="left">
              <form method="post">
              <?php if(get_option('hatchbuck_addons_scroll-box')): ?>
                <input type="hidden" name="addon" value="scroll-box"/>
                <input type="Submit" name="deactivate" class="button button-secondary button-large" value="Deactivate">
              <?php else: ?>
                <input type="hidden" name="addon" value="scroll-box"/>
                <input type="Submit" name="activate" class="button button-primary button-large" value="Activate">
              <?php endif; ?>
                <a name="setting" class="button button-secondary button-large right" href="admin.php?page=scroll-box-settings">Setting</a>
              </form>
            </div>
          </div><!-- inside -->
        </li>
				
				<li class="postbox">
          <h3 class="hndle"><span>Side-wide Tracking</span></h3>
          <div class="inside">
            <img src="<?php echo plugin_dir_url( __FILE__ ); ?>image/blank.png"/>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut tellus nulla. Integer fermentum sapien a tincidunt gravida.</p>
            <div align="left">
              <form method="post">
              <?php if(get_option('hatchbuck_addons_side-wide')): ?>
                <input type="hidden" name="addon" value="side-wide"/>
                <input type="Submit" name="deactivate" class="button button-secondary button-large" value="Deactivate">
              <?php else: ?>
                <input type="hidden" name="addon" value="side-wide"/>
                <input type="Submit" name="activate" class="button button-primary button-large" value="Activate">
              <?php endif; ?>
              </form>
            </div>
          </div><!-- inside -->
        </li>
				
				<li class="postbox">
          <h3 class="hndle"><span>Metaboxes</span></h3>
          <div class="inside">
            <img src="<?php echo plugin_dir_url( __FILE__ ); ?>image/blank.png"/>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ut tellus nulla. Integer fermentum sapien a tincidunt gravida.</p>
            <div align="left">
              <form method="post">
              <?php if(get_option('hatchbuck_addons_metabox')): ?>
                <input type="hidden" name="addon" value="metabox"/>
                <input type="Submit" name="deactivate" class="button button-secondary button-large" value="Deactivate">
              <?php else: ?>
                <input type="hidden" name="addon" value="metabox"/>
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