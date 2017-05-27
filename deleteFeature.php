<?php
    include_once('php/dbConnection.php');
    include_once('content.php');
    
     
        session_start();
        
         if(!isset($_SESSION['admin'])){
            header("Location: php/error.php");
        }

	   $id =  $_REQUEST['id'];
	
    $connection ;
        
	 
    $query = "DELETE FROM about_feature WHERE id='$id'";

    mysqli_query($connection, $query);
    
    getFeatureBody();
                                     

?>
