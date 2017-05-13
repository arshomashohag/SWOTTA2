 
 <?php
    include_once('dbConnection.php');
    
    
    $cid =  $_GET['q'];

    global $connection ;

    $query = "SELECT * FROM content WHERE scid='$cid'";

    $result = mysqli_query($connection, $query);


    while($row=mysqli_fetch_assoc($result)){
      $link= "../".$row['image'];
      
    if(file_exists($link)){
        unlink($link);
    }
  }


  mysqli_query($connection, "DELETE FROM content WHERE scid='$cid'");



    $query = "DELETE FROM subcategory WHERE id='$cid'";

     mysqli_query($connection, $query);

     if(mysqli_affected_rows($connection)){

           print("Deleted Successfully !!");

        }

      else print("Something went wrong !! Please Try Again");
    
?>