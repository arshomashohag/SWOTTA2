<?php
    session_start();

   if( isset($_SESSION['email'])){
   	  $_SESSION['email']=null;
   	  unset($_SESSION['email']);
   }
   if(isset($_SESSION['admin'])){
   	  $_SESSION['admin']=null;
   	  unset($_SESSION['email']);
   }

    unset($_SESSION);
    session_unset();
    session_destroy();
    
    header("Location: index.php");
    
?>