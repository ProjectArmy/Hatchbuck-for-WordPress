<?php

global $wpdb;
// Load the options


if($_POST){
	
$_POST=hatchbuck_trim_deep($_POST);
$_POST = stripslashes_deep($_POST);
  
  $hatchbuck_limit = abs(intval($_POST['hatchbuck_limit']));
  if($hatchbuck_limit==0)$hatchbuck_limit=20;
  
  $hatchbuck_credit = $_POST['hatchbuck_credit'];
  
  
  update_option('hatchbuck_limit',$hatchbuck_limit);

  if(isset($_POST['disable_help'])) {
    update_option('hatchbuck_help_script',null);
  } else {
    update_option('hatchbuck_help_script',1);
  }
	
	if(isset($_POST['hatchbuck_sw_code']) && $_POST['hatchbuck_sw_code']) {
		update_option('hatchbuck_sw_code',$_POST['hatchbuck_sw_code']);
  } else {
    update_option('hatchbuck_sw_code',null);
  }
	
  header('Location: admin.php?page=hatchbuck-settings&notice=1');
?>



<?php
}

?>

<?php if(isset($_GET['notice'])): ?>
<div class="system_notice_area_style1" id="system_notice_area">
	Settings updated successfully. &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php endif; ?>

<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2">

<div id="postbox-container-2" class="postbox-container">
<div class="postbox">

	<h3 class="hndle"><span>Settings</span></h3>
    <div class="inside">
    
	<form method="post">
	<table style="width:99%;">
						
			<tr valign="top">
				<td scope="row" class=" settingInput" id="" style="width: 25%;"><label for="hatchbuck_limit">Pagination limit (forms per page)</label></td>
				<td id=""><input  name="hatchbuck_limit" type="text"
					id="hatchbuck_limit" value="<?php if(isset($_POST['hatchbuck_limit']) ){echo abs(intval($_POST['hatchbuck_limit']));}else{print(get_option('hatchbuck_limit'));} ?>" />
				</td>
			</tr>
      
      <tr valign="top">
				<td scope="row" class=" settingInput" id="" style="width: 25%;"><label for="hatchbuck_limit">Disable orange "Get Marketing Help" button</label></td>
				<td>
          <input type="checkbox" name="disable_help" value="disabled" <?php echo (!get_option('hatchbuck_help_script'))?'checked':''; ?>/>
				</td>
			</tr>
			
			<?php if(get_option('hatchbuck_addons_side-wide')): ?>
				<tr valign="top">
					<td scope="row" class=" settingInput" id="" style="width: 25%;"><label for="hatchbuck_limit">Add tracking to entire website</label></td>
					<td>
						<textarea name="hatchbuck_sw_code" style="width:70%;height:150px;"><?php echo get_option('hatchbuck_sw_code'); ?></textarea>
					</td>
				</tr>
			<?php endif; ?>
      
			<tr valign="top">
				<td scope="row" class=" settingInput" id="bottomBorderNone">
				</td>
				<td id="bottomBorderNone"><input style="margin:10px 0 20px 0;" id="submit" class="button-primary bottonWidth" type="submit" value=" Update Settings " />
				</td>
			</tr>
			
	</table>

	</form>
  </div><!-- inside -->
  </div><!-- postbox -->
</div><!-- postbox-container-2 -->


<?php require( dirname( __FILE__ ) . '/sidebar.php' ); ?>

</div><!-- postbody -->
</div><!-- poststuff -->