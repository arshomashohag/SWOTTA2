<?php
include_once('dbConnection.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}




if(isset($_REQUEST['comment'])){

	$isextra=null;

	 if(isset($_REQUEST['extra']))
	 	$isextra = true;

   $userid=null;

	if(isset($_SESSION['admin'])){
        $admin = getAdmin($_SESSION['email']);

        $userid = $admin['id'];
        $utype = 2;
	}

  else if(isset($_SESSION['id'])){
      $utype=1;
  	  $userid = $_SESSION['id'];
  }
	 
  if(isset($userid)){
   $pid = $_REQUEST['pid'];
   $comment = $_REQUEST['comment'];

      $comment = nl2br(htmlentities($comment, ENT_QUOTES, 'UTF-8'));

      $time = date("Y-m-d H:i:s");
       
   if(isset($isextra)){
   		$query = "INSERT INTO extracomments (userid, pid, comment, utype, createdat) VALUES ('$userid', '$pid', '$comment', '$utype', '$time')";
   	}

   else{
   		$query = "INSERT INTO comments (userid, pid, comment, utype, createdat) VALUES ('$userid', '$pid', '$comment', '$utype', '$time')";
   	}

   mysqli_query($connection, $query);

   echo getComments($pid, $isextra);
 }

   return;
  
	
}


else if (isset($_SESSION['admin']) && isset($_REQUEST['delete']) && isset($_REQUEST['pid'])) {
	$isextra=null;

	 if(isset($_REQUEST['extra']))
	 	$isextra = true;


	 $pid = $_REQUEST['pid'];
	 $id = $_REQUEST['id'];

	 if(isset($isextra)){
          $query = "DELETE FROM extracomments WHERE id='$id' AND pid='$pid'";
	 }
	
	else {
		$query = "DELETE FROM comments WHERE id='$id' AND pid='$pid'";
	}

	 mysqli_query($connection, $query);
     
     echo getComments($pid,  $isextra);
     return;
}



function getComments($pid, $isextra=null){
   
   global $connection;
   $admin=false;
   $user=false;
   $userid = 0;
    

   if(isset($_SESSION['admin'])){
      $admin=true;
   }
   elseif(isset($_SESSION['id'])){
       $userid = $_SESSION['id'];
       $user=true;
   }
  

   if(!isset($isextra)){
   $query = "SELECT * FROM comments WHERE pid='$pid' ORDER BY createdat ASC";
}
else{
	$query = "SELECT * FROM extracomments WHERE pid='$pid' ORDER BY createdat ASC";
}

   $result = mysqli_query($connection, $query);

   $return = '<table class="table table-striped">
                <thead>
	                <tr>
		                <td>
		                	<h2> Comments</h2>
		                </td>
	                </tr>
                </thead>
                <tbody>';

   while ($comment = mysqli_fetch_assoc($result)) {

   	$time = strtotime($comment['createdat']);
    $since = humanTiming($time).' ago';
    //$since = time()-$time;
    
     if($comment['utype'] != 2){
   	    $username = getUsername($comment['userid']);
   	}

   	 else {
   	 	$username =  getUsername($comment['userid'], true);
   	 }

   	 $return .= '<tr>
   	             <td>
   	             <p><span class="usernameincomment">'
   	            .$username.' : </span>'
   	            .br2nl($comment['comment'])
   	            .'</p>';
   	 $return .= '<p><span>'.$since.' ';
   	 if($admin){
   	 	$return .= '<a onclick="deleteComment(\''.$comment['id'].'\', \''.$pid.'\')">delete</a></span></p>';
   	 }


                   
   	 $return .= '</td></tr>';


   }


   $return .= '<tr><td>';

   if($user || $admin){
   $return .= '<textarea class="form-control" rows="2" id="commenttext"></textarea>';
   $return .= '<button class="btn btn-info" onclick="addComment(\''.$pid.'\')">Comment</button>';
   }
   else{
   	 $return .= '<textarea class="form-control" rows="2" id="commenttext" disabled>Log in to comment</textarea>';
     $return .= '<button class="btn btn-info" disabled >Comment</button>';
   }
   $return .= '</td></tr></table>';


    return $return;

}


function getUsername($userid, $isadmin=null){

	global $connection;


	$query = "SELECT * FROM ";
  if(isset($isadmin))
  $query .= "admin WHERE id='$userid'";

  else $query .= "users WHERE id='$userid'"; 

	$r = mysqli_query($connection, $query);

	$user = mysqli_fetch_assoc($r);
	return $user['name'];

}

function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}

function br2nl( $input ) {
    return preg_replace('/<br\s?\/?>/ius', "\n", str_replace("\n","",str_replace("\r","", htmlspecialchars_decode($input))));
}


function getAdmin($email){
   global $connection;

   $query = "SELECT * FROM admin WHERE email='$email' ";

   $result = mysqli_query($connection, $query);

   if($result)
    return mysqli_fetch_assoc($result);
  else
    return 404;
}


?>