<?php 
	//------------------- Edit here --------------------//
	$sendy_url = 'https://emails.projectarmy.net';
	$list = 'JLJ1AtjTY892QJOyfib763phtA';
	//------------------ /Edit here --------------------//

	//--------------------------------------------------//
	//POST variables
	$name = $_POST['name'];
	$email = $_POST['email'];
	$lastname = $_POST['lname'];
  $date = strftime('%b %d, %G', time());
	
	//subscribe
	$postdata = http_build_query(
	    array(
	    'name' => $name,
	    'email' => $email,
      'LastName' => $lastname,
      'SignupDate' => $date,
	    'list' => $list,
	    'boolean' => 'true'
	    )
	);
	$opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
	$context  = stream_context_create($opts);
	$result = file_get_contents($sendy_url.'/subscribe', false, $context);
	//--------------------------------------------------//
	
	echo $result;
?>