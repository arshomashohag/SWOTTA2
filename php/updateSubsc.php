<?php

include_once('newslettersmodel.php');

if(!isset($_REQUEST['userid']) || !isset($_REQUEST['subcat']) || !isset($_REQUEST['cat'])){
	 printf("Not authorised to see the content !!");
}


$userid = $_REQUEST['userid'];
$subcat = $_REQUEST['subcat'];
$cat = $_REQUEST['cat'];
$status = $_REQUEST['status'];

if($status==="true")$status=true;
else $status=false;

 if(updateSubscription($userid, $subcat, $cat, $status)){
 	printf('Updated Successfully!!!');
 }
 else{
 	printf('Something wrong, please try again !!!');
 }

?>