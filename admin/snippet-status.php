<?php

global $wpdb;

$_POST = stripslashes_deep($_POST);
$_GET = stripslashes_deep($_GET);

$hatchbuck_snippetId = intval($_GET['snippetId']);
$hatchbuck_snippetStatus = intval($_GET['status']);
$hatchbuck_pageno = intval($_GET['pageno']);
if($hatchbuck_snippetId=="" || !is_numeric($hatchbuck_snippetId)){
	header("Location:".admin_url('admin.php?page=hatchbuck-manage'));
	exit();

}

$snippetCount = $wpdb->query($wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.HATCHBUCK_TABLE.' WHERE id=%d LIMIT 0,1' ,$hatchbuck_snippetId)) ;

if($snippetCount==0){
	header("Location:".admin_url('admin.php?page=hatchbuck-manage&hatchbuck_msg=2'));
	exit();
}else{
	
	$wpdb->update($wpdb->prefix.HATCHBUCK_TABLE, array('status'=>$hatchbuck_snippetStatus), array('id'=>$hatchbuck_snippetId));
	header("Location:".admin_url('admin.php?page=hatchbuck-manage&hatchbuck_msg=4&pagenum='.$hatchbuck_pageno));
	exit();
	
}
?>