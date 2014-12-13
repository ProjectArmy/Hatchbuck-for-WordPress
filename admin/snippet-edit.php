<?php 

global $wpdb;
global $current_user;
get_currentuserinfo();

$hatchbuck_snippetId = $_GET['snippetId'];

if(isset($_POST) && isset($_POST['updateSubmit'])){

// 		echo '<pre>';
// 		print_r($_POST);
// 		die("JJJ");
	$_POST = stripslashes_deep($_POST);
	$_POST = hatchbuck_trim_deep($_POST);
	
	$hatchbuck_snippetId = $_GET['snippetId'];
	
	$temp_hatchbuck_title = str_replace(' ', '', $_POST['snippetTitle']);
	$temp_hatchbuck_title = str_replace('-', '', $temp_hatchbuck_title);
	
	$hatchbuck_title = str_replace(' ', '-', $_POST['snippetTitle']);
	$hatchbuck_content = $_POST['snippetContent'];

	if($hatchbuck_title != "" && $hatchbuck_content != ""){
		
		if(ctype_alnum($temp_hatchbuck_title))
		{
		$snippet_count = $wpdb->query($wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.HATCHBUCK_TABLE.' WHERE id!=%d AND title=%s LIMIT 0,1',$hatchbuck_snippetId,$hatchbuck_title)) ;
		
		if($snippet_count == 0){
			$hatchbuck_shortCode = '[hatchbuck form="'.$hatchbuck_title.'"]';
			
			$wpdb->update($wpdb->prefix.HATCHBUCK_TABLE, array('title'=>$hatchbuck_title,'content'=>$hatchbuck_content,'short_code'=>$hatchbuck_shortCode,), array('id'=>$hatchbuck_snippetId));
			
			header("Location:".admin_url('admin.php?page=hatchbuck-manage&hatchbuck_msg=5'));
	
		}else{
			?>
			<div class="system_notice_area_style0" id="system_notice_area">
			Form already exists. &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
			</div>
			<?php	
	
		}
		}
		else
		{
			?>
		<div class="system_notice_area_style0" id="system_notice_area">
		Form title can have only alphabets,numbers or hyphen. &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
		</div>
		<?php
		
		}
		
	
	}else{
?>		
		<div class="system_notice_area_style0" id="system_notice_area">
			Fill all mandatory fields. &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
		</div>
<?php 
	}

}


global $wpdb;


$snippetDetails = $wpdb->get_results($wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.HATCHBUCK_TABLE.' WHERE id=%d LIMIT 0,1',$hatchbuck_snippetId )) ;
$snippetDetails = $snippetDetails[0];

?>

<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2">

<div id="postbox-container-2" class="postbox-container">
<div class="postbox">
	<h3 class="hndle"><span>Edit Hatchbuck Form</span></h3>
    <div class="inside">
		<form name="frmmainForm" id="frmmainForm" method="post">
			<input type="hidden" id="snippetId" name="snippetId"
				value="<?php if(isset($_POST['snippetId'])){ echo esc_attr($_POST['snippetId']);}else{ echo esc_attr($snippetDetails->id); }?>">
			<div>
				<table
					style="width: 99%; background-color: #F9F9F9; border: 1px solid #E4E4E4; border-width: 1px;margin: 0 auto">
					<tr><td><br/>
					<div id="shortCode"></div>
					<br/></td></tr>
					<tr valign="top">
						<td style="border-bottom: none;width:20%;">&nbsp;&nbsp;&nbsp;Form Name&nbsp;<font color="red">*</font></td>
						<td style="border-bottom: none;width:1px;">&nbsp;:&nbsp;</td>
						<td><input style="width:80%;"
							type="text" name="snippetTitle" id="snippetTitle"
							value="<?php if(isset($_POST['snippetTitle'])){ echo esc_attr($_POST['snippetTitle']);}else{ echo esc_attr($snippetDetails->title); }?>"></td>
					</tr>
					<tr>
						<td style="border-bottom: none;width:20%; ">&nbsp;&nbsp;&nbsp;Form Code &nbsp;<font color="red">*</font></td>
						<td style="border-bottom: none;width:1px;">&nbsp;:&nbsp;</td>
						<td >
							<textarea name="snippetContent" style="width:80%;height:150px;"><?php if(isset($_POST['snippetContent'])){ echo esc_textarea($_POST['snippetContent']);}else{ echo esc_textarea($snippetDetails->content); }?></textarea>
						</td>
					</tr>				

				<tr>
				<td></td><td></td>
					<td><input class="button-primary" style="cursor: pointer;"
							type="submit" name="updateSubmit" value="Save Your Form"></td>
				</tr>
				<tr><td><br/></td></tr>
				</table>
			</div>

		</form>
    </div><!-- inside -->
</div><!-- postbox -->
</div><!-- postbox-container-2 -->


<?php require( dirname( __FILE__ ) . '/sidebar.php' ); ?>

</div><!-- postbody -->
</div><!-- poststuff -->