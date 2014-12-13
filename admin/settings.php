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

?>


<div class="system_notice_area_style1" id="system_notice_area">
	Settings updated successfully. &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
</div>


<?php
}


?>


<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2">

<div id="postbox-container-2" class="postbox-container">
<div class="postbox">

	<h3 class="hndle"><span>Settings</span></h3>
    <div class="inside">
    
	<form method="post">
	<table style="width:99%;">
						
			<tr valign="top">
				<td scope="row" class=" settingInput" id=""><label for="hatchbuck_limit">Pagination limit</label></td>
				<td id=""><input  name="hatchbuck_limit" type="text"
					id="hatchbuck_limit" value="<?php if(isset($_POST['hatchbuck_limit']) ){echo abs(intval($_POST['hatchbuck_limit']));}else{print(get_option('hatchbuck_limit'));} ?>" />
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