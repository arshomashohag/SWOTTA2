<?php
include_once('php/allFunctions.php');

 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 
$catresult = getCategory();

 

?>

<!DOCTYPE html>
<html>
<head>
  <title>SWOTTA |  Gallery</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<script type="text/javascript" src="assets/js/jquery-min.js"></script> 
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/js/jquery.bxslider.js"></script> 
<script type="text/javascript" src="assets/js/selectnav.min.js"></script> 
<script src="https://use.fontawesome.com/1212fd0a5a.js"></script>

<link rel="stylesheet" type="text/css" href="assets/font/font.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
 
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
          


     <!-- Start Menu Area -->
     <div class="main_menu_area">
                <ul id="nav">
    <?php 
             while ($cat=mysqli_fetch_assoc($catresult)) {

                  printf('<li><a href="allnews.php?catname=%s&cid=%s">%s</a> 

                    <ul> ',$cat['name'],$cat['id'], $cat['name']);

                  $scatresult = getSubCategory($cat['id']);

                  while($scat=mysqli_fetch_assoc($scatresult)){
                      
                        printf('<li><a href="newsdetails.php?cname=%s&scname=%s&cid=%s&scid=%s">%s</a></li>',$cat['name'],$scat['name'],$cat['id'],$scat['id'], $scat['name']);
                    }
                      print('</ul>
                  </li>');
             }                     
        ?>
      </ul>
    </div>

<!--End of menu area-->
           
     <!-- Body Section -->


             
            <?php 

               $result = getAllExtra("gallery");

               printf('<div class="row">
                <div class="col-lg-12">
                <h1 class="page-header">Swotta Gallery</h1>
            </div>
            </div>');
 
 
               $cnt=0;
               $flag = true;

               while ($row=mysqli_fetch_assoc($result)) {

                    if($cnt%4==0){
                      printf('<div class="row">');
                      $flag=false;
                    }
                   printf('<div class="col-lg-3 col-md-4 col-xs-6 thumb">
                           <a class="thumbnail" href="#">
                          <img class="img-responsive" src="%s" alt="">
                       </a>
                       <p>%s</p>
                    </div>', $row['image'], $row['head']);

                  if(($cnt+1)%4==0){
                    print("</div>");
                    $flag=true;
                  }
                  $cnt++;
               }

            if($flag==false){
              printf('</div>');
            }


            ?>

                 
       
    <!-- End Body Section -->

     <div style="border-top: 1px dashed black; margin-top: 50px;"></div>

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
