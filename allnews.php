<?php
include_once('php/allFunctions.php');
include_once('php/indexModel.php');
include_once('php/commentsModel.php');

 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 
$catresult = getCategory();

if(!isset($_GET['catname'])){
  header('Location: php/error.php');
}



$pid = null;
$cid = null;

if(isset($_GET['cid'])){
  $cid = $_GET['cid'];
}

if(isset($_GET['pid'])){
  if(isset($cid)){
    header('Location: php/error.php');
  }
  $pid = $_GET['pid']; 
}




$name = $_GET['catname'];



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
	<title>SWOTTA | <?php echo $name;?></title>
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
<link rel="shortcut icon" type="image/png" href="images/icon/favicon.png"/>



<script type="text/javascript">
  function addComment(pid){
    var comment = document.getElementById("commenttext").value;

     var xmlhttp;
       
       
          if (window.XMLHttpRequest){

                                  xmlhttp = new XMLHttpRequest();

                                  }

                                   else{ 
                                     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                  }

                               xmlhttp.onreadystatechange = function(){
                                 
                                 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        document.getElementById("commentsdiv").innerHTML = xmlhttp.responseText;
                                    }

                               }

                              xmlhttp.open("GET", "php/commentsModel.php?pid="+pid+"&comment="+comment+"&extra="+true, true);
                              xmlhttp.send();
                            
                    return;  
  }


  function deleteComment(id, pid){
     var xmlhttp;
       
       
          if (window.XMLHttpRequest){

                                  xmlhttp = new XMLHttpRequest();

                                  }

                                   else{ 
                                     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                  }

                               xmlhttp.onreadystatechange = function(){
                                 
                                 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        document.getElementById("commentsdiv").innerHTML = xmlhttp.responseText;
                                    }

                               }

                              xmlhttp.open("GET", "php/commentsModel.php?id="+id+"&pid="+pid+"&delete="+true+"&extra="+true, true);
                              xmlhttp.send();
                            
                    return;  
 }
</script>

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

	      <section class="bodysection">
	         <!-- Body Head -->
	           <div class="bodyhead"> 
					<span>
						<i class="fa fa-home fa-3x"></i>
						<?php echo " > ".$name; ?>
					</span>
	           </div>
	         <!-- End Body Head -->
			  
			  <!-- Contents Of the body -->
              <div class="contentcontainer">
 					 
					      <?php
                     
                      $tablename = strtolower($name); 

                      $flag=false;
                      $cnt = 1;

 
					      	     if(isset($cid)){
                        if($cid==10000)
                          $result = getPopular();

                        else
                          $result = getAllContents($cid);


                         while($news=mysqli_fetch_assoc($result)){
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

                                                      <div class="panel-footer"

                                                          <span> 

                                                                <a class="readmore" href="newsdetails.php?cname=%s&scname=%s&cid=%s&scid=%s&pid=%s">
                                                                READ MORE
                                                                </a>

                                                          </span>

                                                      </div>

                                                </div>', $news['head'], $news['createdat'], get_snippet($news['body']),$cat['name'], $subcat['name'], $news['cid'], $news['scid'], $news['id']);



                                       printf(' </div>
                                        <div class="col col-md-1">
                                        </div>
                                        </div>');
                                   
                                     

                               }
                      }

                      else{
                        
                        $result = getAllExtra($tablename, $pid);

                        while($news=mysqli_fetch_assoc($result)){
                                   $flag=true;


                                   

                                           /*if(!empty($news['image'])){
                                                    printf('<img src="%s" >', $news['image']);
                                                 }*/

                                                 if(!isset($pid)){
                                                  printf('

                                                      <div class="row">');

                                                 printf(' 

                                                      
                                                     <div class="col col-md-11">
                                                  
                                                     <div class="panel panel-default">
                                                       <div class="panel-heading">
                                                            <h3 class="text-capitalize">%s</h3>
                                                            <p class="created">at %s</p>
                                                        </div>
                                                      
                                                        <div class="panel-body">
                                                          %s
                                                        </div>

                                                        <div class="panel-footer">
                                                           <span> 

                                                              <a class="readmore" href="allnews.php?catname=%s&pid=%s">
                                                              READ MORE
                                                              </a>

                                                            </span>
                                                      </div>
                                                </div>', $news['head'], $news['createdat'], get_snippet($news['body']), $name, $news['id']);





                                                 printf(' </div>
                                                  <div class="col-md-1">
                                                  </div>
                                                  </div>');
                                                 
                                                 

                                               }



                                               else{
                                                  printf('<div class="row">');

                                                  printf('<div class="col col-md-1"></div>

                                                    <div class="col col-md-10">');

                                                if(!empty($news['image'])){
                                                    printf('<img src="%s" >', $news['image']);
                                                 }

                                                  printf('
                                                  
                                                  <h3 class="text-capitalize">%s</h3>
                                                  <p class="created">at %s</p>
                                                
                                                <div class="newsbody">
                                                  %s
                                                </div>

                                                ', $news['head'], $news['createdat'],$news['body'], $name, $news['id']);


                                               printf(' </div>
                                                <div class="col col-md-1">
                                                </div>
                                                </div>');

                                               printf('
                                                   <br><br>
                                                  <div class="row">
                                                      <div class="col col-md-1"></div>
                                                      

                                                      <div class="col col-md-10" id="commentsdiv">');

                                                           echo getComments($pid, true);

                                                      printf('<div>


                                                      <div class="col-md-1"></div>
                                                  </div>



                                                  ');

                                               }



                                   
                                     

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


 
