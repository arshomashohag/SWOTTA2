
<?php
  include "php/dbConnection.php";
  include "php/allFunctions.php";

 ob_start();
  

 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['admin'])){
            header("Location: index.php");
    }  


if(isset($_GET['id'])){

     $id=$_GET['id'];
     $contents = getIndividualFeature($id); 

  
    while($row=mysqli_fetch_assoc($contents))
    {
      $title=$row['title'];
      $body =$row['body'];
    
    }


}
if(isset($_POST['update_feature']))
   {

      $title=$_POST['title'];
      $body=$_POST['body'];

      $body = nl2br(htmlentities($body, ENT_QUOTES, 'UTF-8'));
     
      // $filetmp = mysqli_real_escape_string($connection,$filetmp);
      

       $r = updateFeature($title,$body,$id);

      if($r){

        $message = "Updated Successfully !!";
       

        }
        else{

            $message = "Something wrong!!! Please try again!!";
      }

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



<script type="text/javascript">
   function selectsubc(id){

    var xmlhttp;
    
     
           if (window.XMLHttpRequest){

                                  xmlhttp = new XMLHttpRequest();

                                  }

                                   else{ 
                                     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                  }

                               xmlhttp.onreadystatechange = function(){
                                 
                                 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        document.getElementById("subcategory").innerHTML = xmlhttp.responseText;
                                    }

                               }

                              xmlhttp.open("GET", "subcategoryajax.php?q=" + id, true);
                              xmlhttp.send();
                            
                    return; 
   }

   $(function(){

    $("#imgInp").change(function(event){
         var tmppath = URL.createObjectURL(event.target.files[0]);
        $("#previewimage").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));

    });
});

 
</script>

 
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
        
                  
           
                    <!--Content pane -->
                   <div role="tabpanel" class="tab-pane" id="content">
                   <div style="border-top: 5px dashed black"></div>
                   <div  >
                    

                    <?php 

                       if(isset($message)){

                        printf('<div class="alert alert-info">%s</div>', $message);

                       }

                    ?>
                  </div>

                             <div class="panel panel-info">

                                     <div class="panel-heading">
                                       <h2>Features</h2>
                                     </div>
                                     <div class="panel-body">
                                        <div class="row">
                                         <!--Add admin column -->
                                             <div class="col-md-9">

                                            <!--Add admin --> 
                                               <div class="panel panel-info">
                                                 <div class="panel-heading"><h3>Edit Feature</h3></div>
                                                 <div class="panel-body">
                                                   <?php
                                                  printf(' <form id="feature_id"  action="featureDetails.php?id=%s" method="post">', $id);
                                                   ?>


                                                       <label for="name">Title</label>
                                                       <input class="form-control" type="text" name="title" value="<?php echo $title; ?>" required>

                                                       <label for="name">Body</label>
                                                       <textarea class="form-control" type="text" name="body" required rows="8"><?php 

                                                             

                                                       echo br2nl($body) ; ?></textarea>

                                                       <button type="submit"  class="form-control btn btn-primary" name="update_feature" >Update</button>

                                                   </form>
                                                 </div>
                                               </div>
                                            <!-- End Add admin -->

                                             </div>
                                             <div class="col-md-3"></div>
                                        </div>
                           
                                       </div>
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