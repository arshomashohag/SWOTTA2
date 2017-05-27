<?php
       include_once('php/allFunctions.php');
       include_once('php/indexModel.php');

        ob_start();
        session_start();
           
      
     $catresult = getCategory();

      $advertisement = getAdvertisement();
      $numAdd = count($advertisement);

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

<link rel="stylesheet" type="text/css" href="assets/font/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="assets/font/font.css" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/about.css"/>
<link rel="shortcut icon" type="image/png" href="images/icon/favicon.png"/>



</head>
<body id="indexbody">
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
     

      <div class="social_plus_search floatright">
        <div class="social">
          <ul>
            <li><a href="#" class="twitter"></a></li>
            <li><a href="#" class="facebook"></a></li>
            <li><a href="#" class="feed"></a></li>
          </ul>
        </div>
        
      </div>
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





<!-- body of about is started-->

<section class="uppersection" >


    <div class="container">
        <div class="row">

             <div class="upperdiv">
               <center>
                  <h2 id="abouthead">ABOUT SWOTTA<h2>
               </center>
             
               
               <p>

               <?php
                    $about = getAbout();
                    $about = mysqli_fetch_assoc($about);

                    printf("%s", br2nl($about['about']));

               ?>

               </p>

             </div>

        </div>


    </div>

 
</section>


<section class="middlesection">
  <div class="container">

        <center>
              <h2 id="featurehead">Feautures</h2>
        </center>



        <?php

           $features = getFeatures();

           $i=0;

           while( ($feature=mysqli_fetch_assoc($features)) && $i<6 ){

                if($i%3===0){

                  if($i!=0){
                      printf("</div>");
                  }
                  printf("<div class='row'>");

                }

                printf('

                      <div class="col-md-4">
                        <p class="col-head">
                          <span class="bold toUpper">
                            %s
                          </span>

                        </p> 
                          <p>%s</p>
                        
                      </div>
                  ', $feature['title'], $feature['body']);

                $i++;

           }

           if($i%3){
             printf('</div>');
           }


        ?>

       
  </div>
</section>


<section class="footersection">
  <div class="container" id="footercontainer">
      <div class="row">
          <!--Address-->
            <div class="col-md-4"></div>

              <div class="col-md-4">

                                      <?php

                                      $r = getContactsInfo();
                                      $address = mysqli_fetch_assoc($r);


                                      ?>
                             

                                         <h2 id="contacthead">Contact Info</h2>

                                          <div class="row">
                             
                                            <div class="col-md-2">
                                                 <i class="fa fa-map-marker fa-fw fa-2x"></i>
                                             </div>
                                             <div class="col-md-10">
                                               <p><?php echo $address['address']; ?></p>
                                             </div>

                                          </div>

                                           <div class="row">

                                            <div class="col-md-2">
                                                 <i class="fa fa-envelope-o fa-fw fa-2x"></i>
                                             </div>
                                             <div class="col-md-10">
                                                <p><?php echo $address['email'];?></p>
                                             </div>

                                          </div>


                                          <div class="row">

                                            <div class="col-md-2">
                                                 <i class="fa fa-phone fa-fw  fa-2x"></i>
                                             </div>
                                             <div class="col-md-10">
                                                <p><?php echo $address['mobile'];?></p>
                                             </div>

                                          </div>



                                

                     
              </div>

              <div class="col-md-4"></div>

            
          
          <!--End address-->

           

      </div>
  </div>
</section>


<!-- body about is ended-->






    <!--Start of fourth add-->
    <div class="footer_top_area">
      <?php
                                       
                     if($numAdd>2){
                      printf('<div class="inner_footer_top"> <img src="%s" alt="" /> </div>', $advertisement[2]['link']);
                    } 
            ?>
      
    </div>
    <!--End of fourth add-->



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
<script src="https://use.fontawesome.com/b3e68927bc.js"></script>


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


