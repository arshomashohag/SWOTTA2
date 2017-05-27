<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


include_once('allFunctions.php');
include_once('aboutModel.php');

function br2nl( $input ) {
    return preg_replace('/<br\s?\/?>/ius', "\n", str_replace("\n","",str_replace("\r","", htmlspecialchars_decode($input))));
}

if(!isset($_SESSION['admin'])){

	include('error.php');
	return;
}

$id = $_REQUEST['id'];

deleteAboutContent($id);

getAboutContents();

?>

 