<?php

global $wpdb;
// Load the options


if($_POST){
	
$_POST=hatchbuck_trim_deep($_POST);
$_POST = stripslashes_deep($_POST);
  
  //post type
  if (isset($_POST['posttype'])) {
    foreach($_POST['posttype'] as $key => $val){
      echo $key.'-'.$val;
      $option[$key] = $val;
    }
  }
  update_option('hatchbuck_postTypeTc',$option);

  $hatchbuck_limit = abs(intval($_POST['hatchbuck_limit']));
  if($hatchbuck_limit==0)$hatchbuck_limit=20;
  
  $hatchbuck_credit = $_POST['hatchbuck_credit'];
  
  
  update_option('hatchbuck_limit',$hatchbuck_limit);

  if(isset($_POST['disable_help'])) {
    update_option('hatchbuck_help_script',null);
  } else {
    update_option('hatchbuck_help_script',1);
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
      
       <tr valign="top">
				<td scope="row" class=" settingInput" id="" style="width: 25%;">
          <br>Select post type to display tracking code
        </td>
				<td>
        <ul>
         <?php 
          $args = array(
            'name' => 'property'
          );
          $output = 'objects'; // names or objects
          $postTypes = get_post_types( '', 'singular_name' );
          $postTypeTc = get_option('hatchbuck_postTypeTc');
          foreach($postTypes as $key => $postType): ?>
            <?php if (in_array( $postType->labels->name,array('attachment','Revisions','Navigation Menu Items','Media'))) {
              continue;
            } ?>
            <li>
              <label><input type="checkbox" name="posttype[<?php echo $key; ?>]" value="1" 
              <?php echo (isset($postTypeTc[$key]))?'checked="checked"':'' ?>/><?php echo $postType->labels->name; ?></label>
            </li>
          <?php endforeach; ?>
         </ul>
				</td>
			</tr>
			
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