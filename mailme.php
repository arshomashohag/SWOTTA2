<?php

session_start();

$subject = "SWOTTA Community News Portal";
$from = $_SESSION['email'];


if(isset($_REQUEST['email']) && isset($_REQUEST['message'])){

 
$email = $_REQUEST['email'];
$message = $_REQUEST['message'];

 $body = <<<EOD
<br><hr><br>
$message <br>
EOD;

$headers = "FROM: $from\r\n";
$headers .= "Content-type: text/html\r\n";

$success = mail($email, $subject, $body, $headers);
if($success){
	printf("Reply Sent to %s", $email);

}
else{
	print("Please try again !!");
	
}
return;

}

else{
	printf("Give me something");
	return;
}

?>

 