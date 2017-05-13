<?php
       include_once('php/allFunctions.php');
       include_once('php/indexModel.php');
       include_once('php/newslettersmodel.php');


        ob_start();
        session_start();
           
      
      $catresult = getCategory();
      $flag=false;
      $isadmin=false;


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
<link rel="stylesheet" type="text/css" href="assets/css/newsletters.css">
<link rel="stylesheet" type="text/css" href="assets/css/newsdetails.css">
<link rel="stylesheet" type="text/css" href="assets/css/contact.css">

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


<script type="text/javascript">
  
function updateSubscription(userid, subcat, cat, ths){

var xmlhttp;
var status = $(ths).prop('checked');
 
       
          if (window.XMLHttpRequest){

                                  xmlhttp = new XMLHttpRequest();

                                  }

                                   else{ 
                                     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                  }

                               xmlhttp.onreadystatechange = function(){
                                 
                                 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        var element = document.getElementById("print");
                                        element.className="alert alert-info";
                                        element.innerHTML = xmlhttp.responseText;
                                    }

                               }

                              xmlhttp.open("GET", "php/updateSubsc.php?userid="+userid+"&subcat="+subcat+"&cat="+cat+"&status="+status, true);
                              xmlhttp.send();
                            
                    return; 
}



</script>




</head>
<body >
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

                $flag = true;

                $email=$_SESSION['email'];

                 
                if(isset($_SESSION['admin'])){
                  $isadmin = true;
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
    </div>


     <!-- Body Main Content -->
     <section class="content">

        <?php
          if(!$flag){
             printf('<div  style="min-height: 100vh" class="cotainer">
              <div class="alert alert-danger">
                 <center>Log in first </center>
              </div></div>');
          }
          else if($isadmin){

             printf('<div style="min-height: 100vh" class="cotainer">
              <div class="alert alert-danger">
                 <center>Admin can not have any newsletters!!!</center>
              </div></div>');

          }

          else{
            ?>

            <div class="panel panel-info">

                <div class="panel-heading">
                    <center>
                    <h2>
                      User Panel 
                    </h2>
                    </center>
                </div>

                <div class="panel-body">

                  <!-- Nav tabs -->
                       <ul class="nav nav-tabs nav-justified" role="tablist">
                         <li role="presentation" class="active"><a href="#news" aria-controls="home" role="tab" data-toggle="tab">Newsletters</a></li>
                         <li role="presentation" ><a href="#subscription" aria-controls="profile" role="tab" data-toggle="tab">Subscription</a></li>

                         <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>

                         
                       </ul>
                    <!-- ENd nav tabs -->


                    <!-- Tab panes -->

                       <div class="tab-content">
                            
                            <!--User News -->
                            <div role="tabpanel" class="tab-pane fade-in active" id="news">

                                  
                                 <div class="newsletters">

                                  <div class="list-group">

                                  <a class="list-heading list-group-item active">
                                   <h2>My Newsletters</h2>
                                  </a>

                                    <?php

                                         $result = getNewsCategory($_SESSION['id']);

                                         if(mysqli_num_rows($result)===0){
                                           printf('<div class="list-group-item" style="min-width: 100vh;">

                                            <center>No subscribed  news category found !!</center></div>');
                                         }


                                         while ($content=mysqli_fetch_assoc($result)){

                                           $tmpr = getCategoryByCid($content['cat']);
                                           $cat = mysqli_fetch_assoc($tmpr);

                                           $tmpr = getSubCategoryByScid($content['subcat']);
                                           $subcat = mysqli_fetch_assoc($tmpr);

                                              printf('<div class="list-group-item">
                                              <h4 class="list-group-item-heading">%s</h4>', $subcat['name']);

                                              $tmpr = getContents($content['cat'], $content['subcat']);
                                              
                                                    $flag=false;

                                                    printf('<div class="row list-group-item-text">');

                                                    printf('<div class="col-md-1"></div>');
                                                    printf('<div class="col-md-10">');

                                              while ($news=mysqli_fetch_assoc($tmpr)) {
                                                  $flag=true;
                                                     
                                                    
                                                  
                                                        printf('<div class="item">
                                                           <div class="inneritem">');
                                                       if(!empty($news['image'])){
                                                          printf('<img src="%s">', $news['image']);
                                                       }

                                                       printf('
                                                  
                                                  <h2 class="text-capitalize">%s</h2>
                                                  <p class="created">at %s</p>
                                                
                                                <p>
                                                  %s
                                                </p>

                                                    

                                                      <a class="readmore" href="newsdetails.php?cname=%s&scname=%s&cid=%s&scid=%s&pid=%s">
                                                      READ MORE
                                                      </a>

                                                 ', $news['head'], $news['createdat'], get_snippet($news['body']),$cat['name'], $subcat['name'], $news['cid'], $news['scid'], $news['id']);

                                                        
                                                  printf('</div></div>');
                                                  
                                              }


                                            if(!$flag){
                                              printf('<p class="list-group-item-text">No news in this category</p>');
                                            }

                                            printf('</div>');
                                            printf('<div class="col-md-1"></div>');

                                            printf("</div>");

                                            printf('</div>');
                                            
                                         }
                                         

                                     ?>

                                  </div>
                                   
                                 </div>

                                 
                            </div>
                            <!--End User News-->



                            <!-- Subscription -->
                            <div role="tabpanel" class="tab-pane fade-in" id="subscription">

                                   <div class="news-categories">

                                   <!--Pop up started-->
                                    <div class="row">
                                      <center id="print" >
                                        
                                      </center>
                                    </div>

                                    <!--Popoup end-->

                                    <div class="list-group">
                                    <a class="list-heading list-group-item active">
                                     <h2>Select Item For Newsletters</h2>
                                   </a>

                                      <?php

                                           $result = getCategory();

                                           while ($category=mysqli_fetch_assoc($result)) {

                                                printf('<a class="list-group-item">
                                                <h4 class="list-group-item-heading">%s</h4>', $category['name']);
                                                $tmpr = getSubCategory($category['id']);

                                                while ($subcat=mysqli_fetch_assoc($tmpr)) {
                                                       
                                                      
                                                    printf('<span class="list-group-item-text">
                                                      <input type="checkbox"');

                                                        if(isSubscribed($_SESSION['id'], $subcat['id'], $category['id']))
                                                          printf(' checked ');

                                                        printf('id="%s" data-toggle="toggle" data-size="mini" onchange="updateSubscription(%s, %s, %s, this)">
                                                       
                                                       %s 
                                                      </span><br>',$subcat['id'], $_SESSION['id'], $subcat['id'], $category['id'], $subcat['name']);


                                                }


   
                                              printf('</a>');
                                              
                                           }
                                           

                                       ?>

                                    </div>
                                     
                                   </div>
                              
                            </div>
                            <!-- End Subscription -->



                            <!-- User Settings -->
                            <div role="tabpanel" class="tab-pane fade-in" id="settings">

                            <div class="panel panel-primary">

                            <div class="panel-heading">
                              <h2>Profile Settings</h2>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                <!--Add admin column -->
                                <div class="col-md-2">

                                     <!--Message --> 
                                        <!--<div class="panel panel-info">
                                            <div class="panel-heading"><h3>Messages</h3></div>
                                            <div class="panel-body">
                                               
                                            </div>
                                        </div> -->

                                     <!-- End Message -->

                                 </div>
                                 <!-- End add admin column -->

                                 <!--Account  Setting -->
                                 <div class="col-md-8">

                                        <div class="panel panel-info">
                                            <div class="panel-heading"><h3>Change Password</h3></div>
                                            <div class="panel-body">
                                              <form  action="admin.php" method="post">
                                                  <label for="name">Old Password</label>
                                                  <input class="form-control" type="password" name="old" placeholder="Old Password" required>

                                                  <label for="name">New Password</label>
                                                  <input class="form-control" type="password" name="newpass" placeholder="New Password" required>

                                                  <label for="name">Confirm Password</label>
                                                  <input class="form-control" type="password" name="newconfirmpass" placeholder="Re-type Password" required>
                                                 
                                                  <input type="submit"  class="form-control btn btn-primary" name="changepass" value="Change">

                                              </form>
                                            </div>
                                        </div>
                                   
                                 </div>
                                 <!-- Account Setting end -->

                                 <div class="col-md-2"></div>

                                </div>
                            </div>
                          
                        </div>
                              
                            </div>
                            <!-- End Settings.-->
                         
                       </div>

                    <!-- End Tab Pane -->

                </div>

             </div>


            <?php
          } 

        ?>
       
     </section>
     <!-- Body Main Content -->

      
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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