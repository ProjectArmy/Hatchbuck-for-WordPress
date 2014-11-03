<?php 

global $wpdb;

$_POST = stripslashes_deep($_POST);
$_POST = hatchbuck_trim_deep($_POST);

if(isset($_POST) && isset($_POST['addSubmit'])){

// 		echo '<pre>';
// 		print_r($_POST);
// 		die("JJJ");

	$temp_hatchbuck_title = str_replace(' ', '', $_POST['snippetTitle']);
	$temp_hatchbuck_title = str_replace('-', '', $temp_hatchbuck_title);
	
	$hatchbuck_title = str_replace(' ', '-', $_POST['snippetTitle']);
	$hatchbuck_content = $_POST['snippetContent'];
	
	if($hatchbuck_title != "" && $hatchbuck_content != ""){
		if(ctype_alnum($temp_hatchbuck_title))
		{
		
		$snippet_count = $wpdb->query( 'SELECT * FROM '.$wpdb->prefix.HATCHBUCK_TABLE.' WHERE title="'.$hatchbuck_title.'"' ) ;
		if($snippet_count == 0){
			$hatchbuck_shortCode = '[hatchbuck form="'.$hatchbuck_title.'"]';
			$wpdb->insert($wpdb->prefix.HATCHBUCK_TABLE, array('title' =>$hatchbuck_title,'content'=>$hatchbuck_content,'short_code'=>$hatchbuck_shortCode,'status'=>'1'),array('%s','%s','%s','%d'));
			
			header("Location:".admin_url('admin.php?page=hatchbuck-manage&hatchbuck_msg=1'));
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

?>

<div >
	<fieldset
		style="width: 99%; border: 1px solid #F7F7F7; padding: 10px 0px;">
		<legend>
			<b>Add Hatchbuck Form</b>
		</legend>
		<form name="frmmainForm" id="frmmainForm" method="post">
			
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
							type="text" name="snippetTitle"
							value="<?php if(isset($_POST['snippetTitle'])){ echo esc_attr($_POST['snippetTitle']);}?>"></td>
					</tr>
					<tr>
						<td style="border-bottom: none;width:20%; ">&nbsp;&nbsp;&nbsp;Form Code &nbsp;<font color="red">*</font></td>
						<td style="border-bottom: none;width:1px;">&nbsp;:&nbsp;</td>
						<td >
							<textarea name="snippetContent" style="width:80%;height:150px;"><?php if(isset($_POST['snippetContent'])){ echo esc_textarea($_POST['snippetContent']);}?></textarea>
						</td>
					</tr>				

				<tr>
				<td></td><td></td>
					<td><input class="button" style="cursor: pointer;"
							type="submit" name="addSubmit" value="Create Your Form"></td>
				</tr>
				<tr><td><br/></td></tr>
				</table>
			</div>

		</form>
	</fieldset>

</div>
