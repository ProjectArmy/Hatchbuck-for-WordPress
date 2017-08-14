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
		Form title can have only letters, numbers or hyphens. &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
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

<div id="poststuff">
<div id="post-body" class="metabox-holder columns-2">

<div id="postbox-container-2" class="postbox-container">
  <div class="postbox">
    <h3 class="hndle"><span>Add Hatchbuck Form</span></h3>
    <div class="inside">
        
        <form name="frmmainForm" id="frmmainForm" method="post">
			<div>
					
					<div class="form-name"><input
							type="text" placeholder="Name your Hatchbuck form" name="snippetTitle" id="snippetTitle"
							value="<?php if(isset($_POST['snippetTitle'])){ echo esc_attr($_POST['snippetTitle']);}?>">
					</div>
					<div class="form-code">
                            <textarea name="snippetContent" style="width:80%;height:150px;"><?php if(isset($_POST['snippetContent'])){ echo esc_textarea($_POST['snippetContent']);}?></textarea>
                            <div id="ace-editor" style="height: 450px;border: 1px solid #DDD;border-radius: 4px;border-bottom-right-radius: 0px;margin-top: 5px;"></div>
                    </div>			
                    <div class="form-submit-button">
                    <input class="button button-primary" type="submit" name="addSubmit" value="Create Your Form">
                    <a href="<?php echo admin_url( 'admin.php?page=hatchbuck-help' ); ?>" class="what-code">What code should I use?</a>
                    </div>
			</div>

		</form>
        
    </div><!-- inside -->
  </div><!-- postbox -->
</div><!-- postbox-container-2 -->
<?php require( dirname( __FILE__ ) . '/sidebar.php' ); ?>

</div><!-- postbody -->
</div><!-- poststuff -->