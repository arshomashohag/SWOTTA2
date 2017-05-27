
<?php
include_once('php/allFunctions.php');
 

 if(isset($_POST['aboutswotta_add']))
   {
        $about=$_POST['aboutswotta'];

    	  $about = nl2br(htmlentities($about, ENT_QUOTES, 'UTF-8'));
        $about = htmlentities($about, ENT_QUOTES, 'UTF-8');
    	
      
         $message = null;
           

       $r = add_about_swotta($about);
  
      if($r){

       $message= "About contents Saved Successfully !!";
             }

        else{

      			$message = "Something wrong !!! Please try again!!";
            }
    }


    else if(isset($_POST['addcontactinfo']))
    {
    	$address=$_POST['address'];
    	$email=$_POST['email'];
    	$mobile=$_POST['mobile'];
    	$address = nl2br(htmlentities($address, ENT_QUOTES, 'UTF-8'));
        $address = htmlentities($address, ENT_QUOTES, 'UTF-8');
        $message=null;

        $r=add_contact_info($address, $email , $mobile);

        if($r){

       $message= "Contact info Saved Successfully !!";
             }
        else{

      			$message = "Something wrong!!! Please try again!!";
            }

    }


  else if(isset($_POST['addfeature']))
    {
    	$title=$_POST['title'];
    	$body=$_POST['body'];
    	
    	$title = nl2br(htmlentities($title, ENT_QUOTES, 'UTF-8'));
        $body = htmlentities($body, ENT_QUOTES, 'UTF-8');
        $message=null;

        $r=add_feature($title,$body);
        if($r){

       $message= "Feature Saved Successfully !!";
             }
        else{

      			$message = "Something wrong!!! Please try again!!";
            }

    }
   
   // else{
   //  header('Location: php/error.php');
   // }


?>


<!DOCTYPE html>
<html>
<head>
	<title>Message | SWOTTA - A Community News Portal</title>


	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
</head>

<body>

  <div class="container">
		    <center>
					  	<div class="jumbotron" >
					  		<?php 
                                 $back = $_SERVER['HTTP_REFERER'];

					  			if(isset($message)){
					  				printf('<div><strong class="alert alert-info">%s</strong></div>', $message);
					  			}

					  			printf('<div> 
					  							<center>
					  								<a class="btn btn-primary" href="%s">Back</a>
					  							</center>
					  				</div>', $back);

					  		?>

					  	</div>

		  	</center>
  </div>

</body>
</html>

   