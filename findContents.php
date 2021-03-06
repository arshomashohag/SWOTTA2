
<?php
         
        include_once("php/allFunctions.php");
        include_once('content.php');

         
        session_start();

         if(!isset($_SESSION['admin'])){
            header("Location: index.php");
        }  

      if(isset($_POST['signup']))
      {
        $msg = registration();
      }

      if(isset($_GET['cid']) && isset($_GET['sid']) && isset($_GET['cname']) && isset($_GET['sname']))
      {
        $cid=$_GET['cid'];
        $sid=$_GET['sid'];
        $cname=$_GET['cname'];
        $sname=$_GET['sname'];

        $contents=getContents($cid,$sid);
      }

$message=null;

if(isset($_POST['addadmn'])){
     $name = $_POST['name'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $confirmpass = $_POST['confirmpass'];

     $message = addAdmin($email, $password, $confirmpass, $name);

 }

 if(isset($_POST['changepass'])){
     $old = $_POST['old'];
     $new = $_POST['newpass'];
     $newcof = $_POST['newconfirmpass'];

     $message = changeAdminPass($_SESSION['email'], $old, $new, $newcof);
 }


 $catresult = getCategory();

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
  function deleteContent(id, cid, sid){
      var xmlhttp;
    
       
          if (window.XMLHttpRequest){

                                  xmlhttp = new XMLHttpRequest();

                                  }

                                   else{ 
                                     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                                  }

                               xmlhttp.onreadystatechange = function(){
                                 
                                 if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                        document.getElementById('cBody').innerHTML = xmlhttp.responseText;
                                    }

                               }

                              xmlhttp.open("GET", "deleteContent.php?id="+id+"&cid="+cid+"&sid="+sid, true);
                              xmlhttp.send();
                            
                    return;  
  }

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
          <li><a href="#">About</a></li>
          <li><a href="#">Contact us</a></li>
          <li><a href="#">Subscribe</a></li>
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
        
        <div class="panel panel-primary">

           
                    <!--Content pane -->
               
                              <div class="row">  
                                        
                              

                              <div class="col-md-12">
                                   <!--Image Preview-->
                                   <div style="border-top: 5px dashed black"></div>
                                        
                                         
                                             <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                  <span> <h2>Contents of <?php echo $sname; ?></h2></span>
                                                   
                                                
                                            
                                                </div>

                                                <div class="panel-body" id="pBody">
                                              <table class="table-striped table">
                                               <thead>
                                                    <tr>
                                                    <th><h2>Heading</h2></th>
                                                    <th><h2>Image </h2></th>
                                                    <th><h2 class="pull-right">Options</h2></th>
                                                  </tr>
                                                </thead>
                                                               

                                                          <tbody id="cBody">

                               <?php 
                               if(isset($contents)){
                                    while ($row=mysqli_fetch_assoc($contents)) {
                                     printf("<tr>");
                                      printf('<td>
                                        <div id="%s">

                                          <span>%s</span>
                                          <div id="print"></div>

                                        </div>
                                        </td>', $row['id'], $row['head']);
                                       printf('<td>
                                        <div class="image_position">
                                          

                                          <img src="%s" class="img img-responsive image_size_compression" >


                                        </div>
                                        </td>',$row['image']);

                                      printf('<td>
                                                              <span class="pull-right">
                                        <a type="button" class ="btn btn-primary" href="editContentsDetails.php?id=%s">Edit </a>
                                         <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#%sconfirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">Delete </button>
                                       </span>
                                        </td>


                                        <div class="modal fade" id="%sconfirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                  <h4 class="modal-title">Delete Parmanently</h4>
                                                </div>
                                                <div class="modal-body">
                                                  <p>Are you sure about this ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    
                                                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="confirm"  onclick=deleteContent(\'%s\',\'%s\',\'%s\')>Delete</button>
                                                 </div>
                                              </div>
                                            </div>
                                          </div>

                                        ',$row['id'], $row['id'], $row['id'], $row['id'], $row['cid'], $row['scid']);
                                     print("</tr>");
                                  }

                                                    }                                             
                                                               ?>

                                                          </tbody>

                                                         
                                                    </table>


                                                                
                                                  </div>

                                             </div>
                                   <!--End image preview--> 
                                   
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

