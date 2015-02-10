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
    }      
    $noticeval = 'Activated';
  }
  
  if (isset($_POST['deactivate']) && isset($_POST['addon'])) {
    switch ($_POST['addon']) {
      case 'form-widget':
        update_option('hatchbuck_addons_form-widget',null);
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
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sollicitudin</p>
            <div align="center">
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
          <h3 class="hndle"><span>Dummy Addon</span></h3>
          <div class="inside">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sollicitudin </p>
            <div align="center">
              <form method="post">
              <input type="Submit" name="activate" class="button button-primary button-large" value="Activate">
              </form>
            </div>
          </div><!-- inside -->
        </li>
        
  </div><!-- postbox -->
</div><!-- postbox-container-2 -->


<?php require( dirname( __FILE__ ) . '/../../sidebar.php' ); ?>

</div><!-- postbody -->
</div><!-- poststuff -->