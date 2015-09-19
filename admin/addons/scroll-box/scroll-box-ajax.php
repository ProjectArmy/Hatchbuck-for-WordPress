<?php
$email = @$_POST['email'];
$firstName = @$_POST['firstName'];
$lastName = @$_POST['lastName'];


if (empty($email) || empty($firstName) || empty($lastName)) {
    print "<p class='hatchbuck_error'>Please fill the form.</p>";
}
else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    print "<p class='hatchbuck_error'>Invalid email.</p>";
}
else {
    $scrollBoxKey = 'hatchbuck_scroll-box_data';
    $data = get_option($scrollBoxKey);
    if ($data)  print "<p class='hatchbuck_info'>" .$data['hb_thank_you'] . "</p>";
    else print "<p class='hatchbuck_info'>Thank for subscribing." . "</p>";
    
}
?>