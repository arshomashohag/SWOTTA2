
<?php
   session_start();
  include "php/dbConnection.php";
  include "php/allFunctions.php";

  
if(!isset($_SESSION['email']) || !isset($_SESSION['admin'])){
            include('php/error.php');
            return;
    } 

    $message = null; 

if(isset($_POST['updateabout'])){
      
      $about = $_POST['aboutswotta'];
      $id = $_POST['aboutid'];

      $about = nl2br(htmlentities($about, ENT_QUOTES, 'UTF-8'));
      

            
           

       $r = updateAbout($id, $about);

      if($r){

        $message = "Updated Successfully !!";
       

    }
        else{

            $message = "Something wrong!!! Please try again!!";
      }

   }




 
	if(isset($_GET['id'])){

  

     $id=$_GET['id'];
	$contents = getAbout($id);
		 $row=mysqli_fetch_assoc($contents);
			  
	      $content=$row['about'];


}

	else{
		include('php/error.php');
	    return;
	}


 function br2nl( $input ) {
    return preg_replace('/<br\s?\/?>/ius', "\n", str_replace("\n","",str_replace("\r","", htmlspecialchars_decode($input))));
}

 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SWOTTA - A Community News Portal</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<script type="text/javascript" src="assets/js/jquery-min.js"></script> 
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/js/jquery.bxslider.js"></script> 
<script type="text/javascript" src="assets/js/selectnav.min.js"></script>
<script type="text/javascript" src="assets/js/myJs.js"></script>


<link rel="stylesheet" type="text/css" href="assets/font/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="assets/font/font.css" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/myStyle.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" media="screen" />
<link rel="shortcut icon" type="image/png" href="images/icon/favicon.png"/>

 

 
</head>

<body>


<div class="body_wrapper">
  <div class="center">

    <div class="header_area">
      <div class="logo floatleft"><a href="#"><img src="images/logo12.png" alt="" /></a></div>

       <br>
       <br>
       <br>
       <br>
      <span class="top_menu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact us</a></li>
          <li><a href="newsletters.php">Subscribe</a></li>
            <?php 
          if(isset($_SESSION['email'])){
                $email=$_SESSION['email'];

                if(isset($_SESSION['admin'])){
                  print('<li><a href="admin.php">Admin</a></li>');
                }
                 
                  print('<li><a href="logout.php">Logout</a></li>');
                 

              }

               else { 
                print('<li><a href="login.php">Login</a></li>');
             }

        ?>
        </ul>
      </span>
   </div>
          
           
          
      <section>
        
                 <div class="panel panel-info">

                        <div class="panel-heading">
                          <h2>Update About Us Content</h2>
                        </div>
                        <div class="panel-body">
                            <?php 

                            if(isset($message)){

                             printf(' 
                                     <script language="javascript"> 
									 alert("%s") 
									 </script> 
                             	', $message);

                           	}

                           	?>
                           <div class="row">
                           
                            <!--Add admin column -->
                               <div class="col-md-1"></div>
                                <div class="col-md-10">
                                
                               <!--Add admin --> 
                                  <div class="panel panel-info">
                                      <div class="panel-heading"><h3>Content</h3></div>
                                      <div class="panel-body">
                                        
                                        <?php printf('<form id="aboutswotta_id" action="editabout.php?id=%s" method="post">', $id);?>

                                            <label for="name">About Swotta</label>
                                            <textarea class="form-control" type="text" name="aboutswotta" placeholder="About Swotta" rows="8" required><?php
                                            echo br2nl($content); ?></textarea>
                                            <?php printf('<input type="hidden" name="aboutid" value="%s">',$id);?> 
                                            <button type="submit"  class="form-control btn btn-primary" name="updateabout">Update</button>

                                        </form>
                                      </div>
                                  </div>
                               <!-- End Add admin -->

                                </div>
                                <div class="col-md-3">
                                  
                                </div>
                           </div>

                          </div>
                   </div> 
           
      </section>

     </div>
  </div>

<script type="text/javascript">
  
selectnav('nav', {
    label: '-Navigation-',
    nested: true,
    indent: '-'
});
selectnav('f_menu', {
    label: '-Navigation-',
    nested: true,
    indent: '-'
});
$('.bxslider').bxSlider({
    mode: 'fade',
    captions: true
});
</script>
</body>
</html>


