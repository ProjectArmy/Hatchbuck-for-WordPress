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

<div>

	
	<form method="post">
	<div style="float: left;width: 98%">
	<fieldset style=" width:100%; border:1px solid #F7F7F7; padding:10px 0px 15px 10px;">
	<legend ><h3>Settings</h3></legend>
	<table class="widefat"  style="width:99%;">
						
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
	</fieldset>
	
	</div>

	</form>
</div>