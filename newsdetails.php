<?php
include_once('php/allFunctions.php');
include_once('php/indexModel.php');


if(!isset($_GET['cname']) || !isset($_GET['cid']) || !isset($_GET['scid']) || !isset($_GET['scname'])){
  header('Location: php/error.php');
}

$cid = $_GET['cid'];
$scid = $_GET['scid'];
$cname = $_GET['cname'];
$scname = $_GET['scname'];
$pid= null;

if(isset($_GET['pid'])){
  $pid = $_GET['pid'];

  updateReadCount($pid, $scid, $cid);
}

if (session_status() == PHP_SESSION_NONE) {
    ob_start();
   session_start();
   $catresult = getCategory();
}


                      function get_snippet( $str, $wordCount=50) {
                         return implode( 
                           '', 
                           array_slice( 
                             preg_split(
                               '/([\s,\.;\?\!]+)/', 
                               $str, 
                               $wordCount*2+1, 
                               PREG_SPLIT_DELIM_CAPTURE
                             ),
                             0,
                             $wordCount*2-1
                           )
                         );
                       }


?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $scname;?></title>
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
<link rel="stylesheet" type="text/css" href="assets/css/newsdetails.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/myStyle.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/contact.css">

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
          <li><a href="#">About</a></li>
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

	      <section class="bodysection">
	         <!-- Body Head -->
	           <div class="bodyhead"> 
					<span>
						<i class="fa fa-home fa-3x"></i>
						<?php echo " > ".$cname." > ".$scname; ?>
					</span>
	           </div>
	         <!-- End Body Head -->
			  
			  <!-- Contents Of the body -->
              <div class="contentcontainer">
 					 
					      <?php
                     

					      	   
                      $flag=false;
                      $cnt=1;
                       $specific = null;


                      if(isset($pid)){
                           $r = getSpecific($pid);
                           $specific = mysqli_fetch_assoc($r);

                           $flag=true;


                           printf('

                            <div class="row">

                                 

                                <div class="col col-md-11">');

                                   if(!empty($specific['image'])){
                                            printf('<img src="%s" >', $specific['image']);
                                         }
                                         printf('
                                          
                                          <h3 class="text-capitalize">%s</h3>
                                          <p class="created">at %s</p>
                                        
                                        <div class="newsbody">
                                          %s
                                        </div>', $specific['head'], $specific['createdat'], $specific['body']);



                               printf(' </div>
                                <div class="col col-md-1">
                                </div>
                                </div>');
                        }

                        else{
                              $result = getContents($cid, $scid);

                               while($news = mysqli_fetch_assoc($result)){
                                   $flag=true;

                                   $tmpr = getSubCategoryByScid($news['scid']);
                                   $subcat = mysqli_fetch_assoc($tmpr);

                                   $tmpr = getCategoryByCid($news['cid']);
                                   $cat = mysqli_fetch_assoc($tmpr);



                                   printf('

                                    <div class="row">

                                         

                                        <div class="col col-md-11">');

                                           /*if(!empty($news['image'])){
                                                    printf('<img src="%s" >', $news['image']);
                                                 } */

                                                 printf('
                                                  <div class="panel panel-default">

                                                    <div class="panel-heading">
                                                        <h3 class="text-capitalize">%s</h3>
                                                        <p class="created">at %s</p>
                                                    </div>
                                                 
                                                 
                                                    <div class="panel-body">
                                                      %s
                                                    </div>
                                                 
                                                    <div class="panel-footer">
                                                          <spna style="color: Red; margin-top: 5px;"> 

                                                                <a class="readmore" href="newsdetails.php?cname=%s&scname=%s&cid=%s&scid=%s&pid=%s">
                                                                READ MORE
                                                                </a>

                                                          <span>
                                                    </div>

                                                </div>', $news['head'], $news['createdat'], get_snippet($news['body']),$cat['name'], $subcat['name'], $news['cid'], $news['scid'], $news['id']);



                                       printf(' </div>
                                        <div class="col col-md-1">
                                        </div>
                                        </div>');
                                     

                                }

                              

                              }

                           
                                    
                           
                               if(!$flag){
                                  print('<center>
                                      <h3>Currently No news in this category !! Please visit later<h3>
                                    </center>');
                               }



                                
					      ?>
						
					 
              	     
              </div>
			<!-- End Content -->
	         
	      </section>

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
