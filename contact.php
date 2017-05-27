<?php
include_once('php/allFunctions.php');
session_start();



?>

<!DOCTYPE html>
<html>
<head>
	<title>SWOTTA | Contact</title>


	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" type="text/css" href="assets/font/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/font/font.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="assets/css/contact.css">
  <link rel="shortcut icon" type="image/png" href="images/icon/favicon.png"/>


  <script type="text/javascript">

  function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
   }



     function sendmessage(){

      var print =  document.getElementById("print");
      var innerprint = document.getElementById("innerprint");
     
      var message = document.getElementById("message").value;
      var email = document.getElementById("email").value;
      var name = document.getElementById("name").value;

      
       if(name==="" || name==null){

         print.className = "alert alert-danger";
         innerprint.innerHTML = "Put your name !!";
         return;

       }
       
       if(!validateEmail(email)){
         print.className = "alert alert-danger";
         innerprint.innerHTML = "Give a valid email !!";
         return;
       }
       if(message==="" || message==null){
           print.className = "alert alert-danger";
           innerprint.innerHTML = "Leave a message !!";
           return;
       }
      print.className = "";
      innerprint.innerHTML="";
       
      
       
          if (window.XMLHttpRequest){

                                  xmlhttp = new XMLHttpRequest();

                                  }

                                   else{ 
                                     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                  }

                               xmlhttp.onreadystatechange = function(){
                                 
                                 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        print.className = "alert alert-success";
                                        innerprint.innerHTML= xmlhttp.responseText;
                                        
                                    }

                               }

                              xmlhttp.open("GET", "php/messageme.php?name="+name+"&email="+email+"&message="+message, true);
                              xmlhttp.send();
                            
                    return;
                  
     }
  </script>

</head>


<body>

<div class="body_wrapper">

 <!--Start of center div-->
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
                
                 
                  printf('<li><a href="logout.php">Logout</a></li>');
                 
              }

               else { 
                print('<li><a href="login.php">Login</a></li>');
             }

        ?>
           
          
           
        </ul>
      </span>
     </div>



    <div class="container">

 	     <div class="jumbotron">

             <div class="row" id="print">

                 
                   <cneter id="innerprint" ></cneter>
                 

             </div>
            

           <div>
		           <center><h1 >Say Hello</h1></center>
		       </div>

			 
				    <div class="form-group">
             
				    <input class="form-control" type="text"  id="name" name="name" placeholder="Name">
            </div>

            <div class="form-group">
           <input class="form-control" type="email" id="email"  name="email" placeholder="Email address" required>
            </div>
				    
				     
				   
            <div class="form-group">
             <textarea class="form-control"  type="text" id="message"  name="message" placeholder="Message" rows="8" required></textarea>
            </div>
				  		
              <div class="form-group">
                 <input  type="button" value="Send" id="submit" name="sendmessage" class="btn btn-primary form-control" onclick="sendmessage()">
            </div>		    
				  
			 
	</div>

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