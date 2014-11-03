<?php
global $wpdb;

$_POST = stripslashes_deep($_POST);
$_GET = stripslashes_deep($_GET);

$hatchbuck_snippetId = intval($_GET['snippetId']);
$hatchbuck_pageno = intval($_GET['pageno']);

if($hatchbuck_snippetId=="" || !is_numeric($hatchbuck_snippetId)){
	header("Location:".admin_url('admin.php?page=hatchbuck-manage'));
	exit();

}
$snippetCount = $wpdb->query($wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.HATCHBUCK_TABLE.' WHERE id=%d LIMIT 0,1',$hatchbuck_snippetId )) ;

if($snippetCount==0){
	header("Location:".admin_url('admin.php?page=hatchbuck-manage&hatchbuck_msg=2'));
	exit();
}else{
	
	$wpdb->query($wpdb->prepare( 'DELETE FROM  '.$wpdb->prefix.HATCHBUCK_TABLE.'  WHERE id=%d',$hatchbuck_snippetId)) ;
	
	header("Location:".admin_url('admin.php?page=hatchbuck-manage&hatchbuck_msg=3&pagenum='.$hatchbuck_pageno));
	exit();
	
}
?>