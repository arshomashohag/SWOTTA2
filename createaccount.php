
<?php
        include "php/dbConnection.php";
        include "php/allFunctions.php";
        ob_start();


        session_start();

        $islogedin = false;

         if(isset($_SESSION['email'])){
            $islogedin = true;
            header("Location: index.php");
        }
       
       $msg=null;

        if(isset($_POST['signup'])){

          $name = $_POST['name'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $confirm_password = $_POST['confirm_password'];
         
          $msg = registration($name, $email, $password, $confirm_password);

      }  

       
      


      ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SWOTTA - A Community News Portal</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" type="text/css" href="assets/font/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="assets/font/font.css" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/myStyle.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/contact.css">
<link rel="shortcut icon" type="image/png" href="images/icon/favicon.png"/>

</head>
<body>
<div class="body_wrapper">
  <div class="center">
    <div class="header_area">
      <div class="logo floatleft"><a href="index.php"><img src="images/logo12.png" alt="" /></a></div>
      <br />
      <br />
      <br />
      <br />
      <span class="top_menu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact us</a></li>
          <li><a href="newsletters.php">Subscribe</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </span>
   </div>


     <?php

     if($islogedin){
      printf('<div class="alert alert-danger">

        <center>Already have an account</center>
                                                 
      </div>');
     }

   else{

     ?>
          
          <div class="container" style="margin: 100px 0px 120px 0px">
            <div class="row">
                 <div class="col-md-3"> </div>

                  
                  <div class="col-md-6">
                        <div class="panel panel-success">

                                 <div class="panel-heading">
                                    <h2 class="text-center login-title">Sign Up</h2>
                                  </div>

                                  <div class="panel-body">
                                  <?php
                                    if ( isset($msg) ) {

                                        ?>
                                        <div class="form-group">
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-info-sign"></span> <?php echo $msg; ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                                      <input type="text" class="form-control fc" name="name" placeholder="Name" required autofocus>

                                      <input type="email" class="form-control fc" name="email" placeholder="Email" required autofocus>
                                      <input type="password" class="form-control  fc" name="password" placeholder="Password" required>

                                       <input type="password" class="form-control fc" name="confirm_password" placeholder="Confirm Password" required>

                                      <button  name="signup" class="btn btn-primary btn-block" type="submit">Sign Up</button>
                                      

                                      <a href="" class="pull-right">Need help? </a><span class="clearfix"></span>


                                      <a href="login.php" class="text-center new-account">Have an account ?</a>
                                    </form>

                                     
                                  </div>

                                </div>
                          </div>
                      </div>

                  <div class="col-md-3"> </div>

            </div>
          

    <?php
     }
    ?>






    <div class="footer_top_area">
      <div class="inner_footer_top"> <img src="images/add3.png" alt="" /> </div>
    </div>
    <div class="footer_bottom_area">
      <div class="footer_menu">
        <ul id="f_menu">
          <?php 
           $catforfooter = getCategory();
             while ($cat=mysqli_fetch_assoc($catforfooter)) {

                  printf('<li><a href="allnews.php?catname=%s&cid=%s">%s</a></li>',$cat['name'],$cat['id'],$cat['name']);
                   
             }                     
        ?>
          
        </ul>
      </div>
      <div class="copyright_text">
        <p>Copyright &copy; 2017. All rights reserved </p>
        <p>Trade marks and images used in the design are the copyright of their respective owners and are used for demo purposes only.</p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="assets/js/jquery-min.js"></script> 
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/js/jquery.bxslider.js"></script> 
<script type="text/javascript" src="assets/js/selectnav.min.js"></script> 
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