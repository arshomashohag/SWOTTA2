<?php

include_once('dbConnection.php');

function isSubscribed($userid, $subcat, $cat){

   global $connection;

   $query = "SELECT * FROM subscription WHERE userid='$userid' AND subcat='$subcat' AND cat='$cat'";

   $result = mysqli_query($connection, $query);

   return mysqli_num_rows($result);
}


function updateSubscription($userid, $subcat, $cat, $status){
	global $connection;

    if($status){
        $query = "INSERT INTO subscription (userid, subcat, cat) VALUES ('$userid', '$subcat', '$cat')";
    }
    else{
        $query = "DELETE FROM subscription WHERE userid='$userid' AND subcat='$subcat' AND cat='$cat'";
    }

     mysqli_query($connection, $query);

    return mysqli_affected_rows($connection);
}

function getNewsCategory($userid){
	global $connection;

	$query = "SELECT * FROM subscription WHERE userid='$userid'";

	return mysqli_query($connection, $query);
}


 


?>