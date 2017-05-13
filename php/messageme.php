<?php
include_once('dbConnection.php');


if(!isset($_REQUEST['name']) || !isset($_REQUEST['email']) || !isset($_REQUEST['message']) ){
	 print("Give name, valid email and a message !!");
	 return;
}

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$message = $_REQUEST['message'];

$message = nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8'));
$name = htmlentities($name, ENT_QUOTES, 'UTF-8');

$message = 

$query = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

mysqli_query($connection, $query);

if(mysqli_affected_rows($connection)){
	print("Message Sent !!!");
	return;
}

else{
    print("Something went wrong . Please try again !!!");
	return;
}


?>