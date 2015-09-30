<?php
$data = get_option($scrollBoxKey);

$email = @$_POST['email'];
$firstName = @$_POST['firstName'];
$lastName = @$_POST['lastName'];

if (empty($firstName) && $data['hb_first_name'] == 1) {
    print "<p class='hatchbuck_error'>Enter first name.</p>";
    return;
}

if (empty($lastName) && $data['hb_last_name'] == 1) {
    print "<p class='hatchbuck_error'>Enter last name.</p>";
    return;
}   

if (empty($email)) {
    print "<p class='hatchbuck_error'>Enter email address.</p>";
    return;
}

if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    print "<p class='hatchbuck_error'>Invalid email.</p>";
}
else {    
    require_once ("hatchbuck_wrapper.php");
    
    
        
    $opts['api_key'] = $data['hb_api_key'];
    $opts['tag_key'] = $data['hb_tag_key'];
    $opts['tag_name'] = "Scroll Box";
	
    $result = subscribe($opts, $email, $firstname, $lastName); // Return 1 if everything successfull    
    
    if ($result == 1) { 
        if ($data)  print "<p class='hatchbuck_info'>" .$data['hb_thank_you'] . "</p>";
        else print "<p class='hatchbuck_info'>Thank for subscribing." . "</p>";
        
        setcookie("hatchbuck_subscribed", 1, time()+3600*24*356);
    }
    else {
        print "<p class='hatchbuck_error'>" . $result . "</p>";
    }
}
?>