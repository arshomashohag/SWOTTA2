<?php
      if (session_status() == PHP_SESSION_NONE) {
          session_start();
      }
       include_once('php/allFunctions.php');
       include_once('php/indexModel.php');

         
           
      
     $catresult = getCategory();
     $catforfooter = $catresult;

      $advertisement = getAdvertisement();
      $numAdd = count($advertisement);



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
<link rel="shortcut icon" type="image/png" href="images/icon/favicon.png"/>

<script type="text/javascript">
  
   window.onload = displayWindowSize;
   window.onresize = displayWindowSize;
    

    function displayWindowSize() {
        myWidth = window.innerWidth;
         
        if(myWidth<500){
          document.getElementById("testslider").innerHTML = "";
          document.getElementById("testslider").className="mobile";
        }

  }
  
</script>


</head>
<body id="indexbody">
<div class="body_wrapper">

 <!--Start of center div-->
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
                
                 
                  printf('<li><a href="logout.php">Logout</a></li>');
                 
              }

               else { 
                print('<li><a href="login.php">Login</a></li>');
             }

        ?>
           
          
           
        </ul>
      </span>
     

         
          
        <div class="search">
  
            <div class="form-group ">
            <form method="post" action="searchnews.php">
                 
                <input type="text" placeholder="Search news" id="sbox" name="searchtext"  />
                <input  type="submit" class="btn btn-default" id="searchform" value="search"/> 
                 
            </form>
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


    <div class="slider_area" id="testslider">

       <div class="slider">
          <ul class="bxslider">

          
        <?php
             $sliders=getIndexSlider();
             $i=0;
            while( ($slider=mysqli_fetch_assoc($sliders)) && $i<10) {

                 printf('
                        <li><img src="%s" alt="" title="%s" /></li>
                  ', $slider['link'], $slider['description']);
                 $i++;
               
             }
          ?>  
             
          
          </ul>
      </div>

          
    </div>

    <!--Start of content area -->

    <div class="content_area">

            <!--Start of main content area (News and other article)-->
            <div class="main_content floatleft">

                  <!--Left column start -->

                  <div class="left_coloum floatleft">


                    <!--Start of From around the world-->
                    <div class="single_left_coloum_wrapper">

                          <h2 class="title">from   around   the   world</h2>

                          <a class="more" href="allnews.php?catname=WorldNews&cid=1">more</a>

                          <?php
                            $result = getFromAround();
                            $i=0;

                            while(($content=mysqli_fetch_assoc($result)) && $i<3) {

                              $tmpr = getSubCategoryByScid($content['scid']);
                              $subcat = mysqli_fetch_assoc($tmpr);

                              
                              if(!empty($content['image'])){
                                printf('
                                     <div class="single_left_coloum floatleft"> <img src="%s" alt="" />

                                     ', $content['image']);
                              }
                                      printf('<h3>%s</h3>
                                       <p>%s</p>
                                      <a class="readmore" href="newsdetails.php?cname=WorldNews&scname=%s&cid=1&scid=%s&pid=%s">read more</a> 
                                      </div>
                               ', $content['head'], get_snippet($content['body']), $subcat['name'],$content['scid'], $content['id']);
                                

                               $i++;
                            }

                          
                       ?>

                          
                    </div>

                    <!--End of From around the world-->


                    <!--Latest Article Started here-->
                    <div class="single_left_coloum_wrapper">
                          <h2 class="title">latest  articles</h2>
                          <a class="more" href="allnews.php?catname=Article">more</a>



                          <?php

                            $result = getArticle();
                            $i=0;

                            while(($content=mysqli_fetch_assoc($result)) && $i<3) {

                              printf('
                                     <div class="single_left_coloum floatleft"> <img src="%s" alt="" />
                                      <h3>%s</h3>
                                      <p>%s</p>
                                      <a class="readmore" href="allnews.php?catname=Article&pid=%s">read more</a> 
                                      </div>
                               ', $content['image'], $content['head'], get_snippet($content['body']), $content['id']);
                                

                               $i++;
                            }

                          
                       ?>

                          

                           
                    </div>
                    <!--End of Latest article -->


                    <!--Gallery Started -->
                    <div class="single_left_coloum_wrapper gallery">

                      <h2 class="title">gallery</h2>
                      <a class="more" href="imagegallery.php">more</a> 



                      <?php 

                          $result = getGallery();
                            $i=0;

                            while(($content=mysqli_fetch_assoc($result)) && $i<6) {

                              printf('
                                <img src="%s" alt="" />
                                ', $content['image']);
                                

                               $i++;
                            }


                      ?>
                      

                    </div>
                    <!--End of gallery-->

                    


                    <!--Start of tech news-->
                    <div class="single_left_coloum_wrapper single_cat_left">

                          <h2 class="title">tech news</h2>
                          <a class="more" href="allnews.php?catname=Technology&cid=4">more</a>

                          <?php 

                          $result = getTechnews();
                            $i=0;

                            while(($content=mysqli_fetch_assoc($result)) && $i<4) {

                               $tmpr = getSubCategoryByScid($content['scid']);
                              $subcat = mysqli_fetch_assoc($tmpr);

                              printf('
                                <div class="single_cat_left_content floatleft">
                                  <h3>%s</h3>
                                  <p>%s</p>
                                  <span>
                                     <a class="readmore" href="newsdetails.php?cname=Technology&scname=%s&cid=%s&scid=%s&pid=%s">
                                     read more 
                                     </a>
                                  </span>
                                  <p class="single_cat_left_content_meta">by <span>SWOTTA</span> |  TECH SPOTLIGHT</p>
                                </div>

                                ', $content['head'], get_snippet($content['body']), $subcat['name'], $content['cid'], $content['scid'], $content['id']);
                                

                               $i++;
                            }


                      ?>
                          
                           

                    </div>
                    <!--End Of Tech News-->


                  </div>

                  <!--End of left column-->


                  <!--Start of Right Column-->
                  <div class="right_coloum floatright">


                          <!--Start of Middle column (From the desk)-->
                          <div class="single_right_coloum">
                            <h2 class="title">from the desk</h2>
                            <ul>


                                     <?php 




                                  $result = getDesk();
                                  $i=0;



                                  while(($content=mysqli_fetch_assoc($result)) && $i<3) {
                                     
 
                                   
                                   
                                   $time = strtotime($content['createdat']);
                                   $since = humanTiming($time).' ago';
                                    


                                    printf('
                                      <li>
                                        <div class="single_cat_right_content">
                                          <h3>%s</h3>
                                          <p>%s</p>
                                          <p class="single_cat_right_content_meta"><a href="allnews.php?catname=Desk&pid=%s"><span>read more</span></a> %s</p>
                                        </div>
                                      </li>

                                      ', $content['head'], substr($content['body'], 0, 300), $content['id'], $since);
                                      

                                     $i++;
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


                               ?>
                           </ul>

                            <a class="popular_more" href="allnews.php?catname=Desk">more</a> 

                            </div>
                           <!--Start of Middle column-->


                          <!--Start of Middle column (Editorial)-->

                          <div class="single_right_coloum">

                            <h2 class="title">editorial</h2>

                            <?php 

                                $result = getEditorial();
                                  $i=0;

                                  while(($content=mysqli_fetch_assoc($result)) && $i<4) {

                                    printf('
                                      <div class="single_cat_right_content editorial"> <img src="%s" alt="" />
                                        <h3><a href="allnews.php?catname=Editorial&pid=%s">%s</a></h3>
                                      </div>
                                    ', $content['image'],$content['id'], $content['head']);
                                      

                                     $i++;
                                  }


                               ?>
 
                              <a class="popular_more" href="allnews.php?catname=Editorial">more</a> 
                          </div>

                          <!--End of Middle column (Editorial)-->
                  </div>


                  <!--End of Right column-->
            </div>
            <!--End of main content (Left newses)-->




            <!--Start of Sidebar-->
            <div class="sidebar floatright">
                  <!--First add -->
                  <?php
                                       
                     if($numAdd>0){
                      printf('<div class="single_sidebar"> <img src="%s" alt="" /> </div>', $advertisement[0]['link']);
                    }                  

                  ?>

                   

                  <!--End of first add -->

                  <!--Start of Sign up -->
                  <div class="single_sidebar">
                    <div class="news-letter">
                      <h2>Sign In </h2>
                      <form action="login.php" method="post">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email"  id="signinemail" required />
                        </div>

                            <div class="form-group">
                              <input type="password" name="password" class="form-control" placeholder="Password" id="signinpassword"  required />
                            </div>
                        
                        <div class="form-group">
                          <input type="submit" class="form-control" name="login" value="SUBMIT" id="form-submit" />
                        </div>

                      </form>
                       <p>Not have an account ?</p>
                      <p> <a href="createaccount.php" style="font-style: italic; ">Sign up</a> to receive our free newsletters!</p>
                       
                      <p class="news-letter-privacy">We do not spam. We value your privacy!</p>
                    </div>
                  </div>
                  <!--End of sign up-->

                    
                    <!--Start of Popular -->
                     <div class="single_sidebar">
                    <div class="popular">
                      <h2 class="title">Popular</h2>
                      <ul>

                      <?php

                      $result = getPopular();
                      $cnt=0;


                       while ($cnt<5 && $content=mysqli_fetch_assoc($result)) {
                          $yrdata= strtotime($content['createdat']);
                          $datetime = date('d M Y', $yrdata);


                          $tmpr = getCategoryByCid($content['cid']);
                          $cat = mysqli_fetch_assoc($tmpr);

                          $tmpr = getSubCategoryByScid($content['scid']);
                          $subcat = mysqli_fetch_assoc($tmpr);

                         printf('<li>
                          <div class="single_popular">

                            <p>%s</p>
                            <h3>%s</h3>
                            <a href="newsdetails.php?cname=%s&scname=%s&cid=%s&scid=%s&pid=%s" class="readmore">Read More</a>
                          </div>
                        </li>', $datetime, $content['head'], $cat['name'], $subcat['name'], $content['cid'], $content['scid'], $content['id']);
                         $cnt++;
                       }
                        

                        ?>
                         
                      </ul>
                      <a class="popular_more" href="allnews.php?catname=Popular&cid=10000">more</a> 
                      </div>
                  </div>

                  <!--End Of popular -->


                  <!--Start of RSS-->

                  <div class="single_sidebar">
                    <div class="popular">
                      <h2 class="title">RSS Feed</h2>

                  <?php
                    $rss = new DOMDocument();
                    $rss->load('http://en.prothom-alo.com/feed/');
                    $feed = array();

                    foreach ($rss->getElementsByTagName('item') as $node) {
                        $nodes = $node->childNodes;
                        $description = null;

                        foreach ($nodes as $n ) {

                            if($n->nodeName == "content:encoded"){
                              $description = $n->textContent;
                            }
                        }

                      $item = array ( 
                        'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                         'desc'=> $description,
                        'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                        'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
                        );
                      array_push($feed, $item);
                    }
                    $limit = 3;
                    $count = count($feed);

                    printf('<ul>');

                    for($x=0;$x<$limit && $x<$count;$x++) {


                      printf('<li style="margin:5px 0px 5px 0px">
                        <div class="single_popular" ');
                      $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
                      $link = $feed[$x]['link'];
                      $description = $feed[$x]['desc'];
                      $date = date('l F d, Y', strtotime($feed[$x]['date']));
                      echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
                      echo '<small><em>Posted on '.$date.'</em></small></p><br>';
                      echo '<p>'.get_snippet($description).'</p>';

                      printf('</div></li>');
                    }
                    printf('</ul>');
                  ?>
                    </div>
                  </div>

                  <!--End of RSS-->


                  <!-- 
                  <?php
                                       
                     if($numAdd>0){
                      printf('<div class="single_sidebar"> <img src="%s" alt="" /> </div>', $advertisement[0]['link']);
                    }                  

                  ?>
                  -->

                   <!--Start Third add-->
                   <div class="single_sidebar">
                      <h2 class="title">AD</h2>
                      <?php
                                       
                     if($numAdd>1){
                      printf('<img src="%s" alt="" /> ', $advertisement[1]['link']);
                    }                  

                  ?>
                   </div>

                
                  <!--End of third add-->

                   </div>
              
            <!--End of sidebar -->
    </div>
  <!--End of content area-->


    
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
  <!--End of cneter div-->

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

