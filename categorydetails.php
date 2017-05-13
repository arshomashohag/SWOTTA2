<?php
 include_once('php/allFunctions.php');


   ob_start();
        session_start();
        
         if(!isset($_SESSION['email']) || !isset($_SESSION['admin'])){
            header("Location:php/error.php");
        }

   $cid = $_GET['id'];
   $name = $_GET['name'];


   
   $result = getSubCategory($cid);
   

?>


<!DOCTYPE html>
<html>
<head>
	<title><?php echo $name?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<script type="text/javascript" src="assets/js/jquery-min.js"></script> 
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/js/jquery.bxslider.js"></script> 
<script type="text/javascript" src="assets/js/selectnav.min.js"></script> 



<link rel="stylesheet" type="text/css" href="assets/font/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="assets/font/font.css" />
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/myStyle.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/responsive.css" media="screen" />
<link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" media="screen" />



<script type="text/javascript">
	
     function editSubc(name, id){
     	var xmlhttp;
                            
           if (window.XMLHttpRequest){

								  xmlhttp = new XMLHttpRequest();

								  }

								   else{ 
								     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						          }

						       xmlhttp.onreadystatechange = function(){
						         
						         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						                document.getElementById(name).innerHTML = xmlhttp.responseText;
						            }

						       }

						      xmlhttp.open("GET", "php/editsubcategory.php?q=" + name, true);
						      xmlhttp.send();
							
                    return;
     }

     function saveupdate(name){
     	var xmlhttp;
     	var id="inp"+name; 
        var up = document.getElementById(id).value;

        if(up=="")up=name;
          
                if (window.XMLHttpRequest){

								  xmlhttp = new XMLHttpRequest();

								  }

								   else{ 
								     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						          }

						       xmlhttp.onreadystatechange = function(){
						         
						         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						                 

                                          document.getElementById('printdiv').className += "alert alert-info";
						         	    	document.getElementById('printalert').innerHTML = "Updated Successfully !!";

						         	    	document.getElementById(name).innerHTML = xmlhttp.responseText;
						            }

						       }

						      xmlhttp.open("GET", "php/updatesubc.php?old=" +name+"&new="+up, true);
						      xmlhttp.send();
							
                    return;
                    
     }

     function deleteSubc(id){

     	var xmlhttp;
                            
           if (window.XMLHttpRequest){

								  xmlhttp = new XMLHttpRequest();

								  }

								   else{ 
								     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						          }

						       xmlhttp.onreadystatechange = function(){
						         
						         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						         	    var response = xmlhttp.responseText;

                                          document.getElementById('printdiv').className += "alert alert-info";
						         	    	document.getElementById('printalert').innerHTML = response;
						         	    	 
						         	    	    var row = document.getElementById(id);
						         	    	    row.parentNode.removeChild(row);
						         							         	    

						                 
						            }

						       }

						      xmlhttp.open("GET", "php/deletesubc.php?q=" + id, true);
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
   
   <!--body part-->
   <section>
   	    

        <div class="panel panel-primary">
		    <div class="panel-heading">
			    <span> <h2><?php echo $name; ?></h2></span>
			</div>

		    <div class="panel-body" id="pBody">
				
				<div class="row"> 

				<div id="printdiv">
					 <center id="printalert">
					 	 
					 </center>
				</div>        

                 <div class="col-md-6">
   	   				<div class="panel panel-info">
	                    <div class="panel-heading">
	                    	<span class="contactHead"><h2>Add Sub Category</h2></span>
	                    </div>
	                    <div class="panel-body">
	                        <form action="addsubc.php" method="post">
	                                             
	                            <label for="subc" >Name</label>
	                            <input class="form-control" type="text" name="subc" id="subc" required>
	                            <?php printf('<input type="text" name="cat" hidden value="%s">',$cid);
	                             ?>
	                            
	                            <button name="add"  type="submit" class="form-control btn btn-primary" style="margin-top:5px">Add</button>

	                        </form>
	                    </div>
					 
						   	   	   

					</div>
				                                                 
		        </div>

		        <div class="col-md-6" style="max-height: 300px; overflow: auto;">
		            <table class="table table-striped">
		            <thead>
		                <tr>
			            	<th><h2>Subcategories</h2></th>
			            	<th><h2 class="pull-right">Options</h2></th>
		            	</tr>
		            </thead>
		            <tbody>
		        	<?php
		        		while ($row=mysqli_fetch_assoc($result)) {
		        			 printf("<tr id='%s'>", $row['id']);
		        			 	printf('<td>
		        			 		<div id="%s">

		        			 		  <span>%s</span>

		        			 		</div>
		        			 		</td>', $row['name'], $row['name']);

		        			 	printf('<td >
                                            <span class="pull-right">
											<button class="btn btn-primary" onclick="editSubc(\'%s\', \'%s\')">Edit</button>
											 <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#%sconfirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">Delete</button></span>
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
                                                    
                                                    <button type="button" class="btn btn-danger" id="confirm" data-dismiss="modal"  onclick=deleteSubc(\'%s\')>Delete</button>
                                                 </div>
                                              </div>
                                            </div>
                                          </div>


											 ',$row['name'],$row['id'] , $row['id'], $row['id'], $row['id']);
		        			 print("</tr>");
		        		}

		        	?>
		        	</tbody>
		        	</table>
		        </div>
		     </div> 

		</div>
				                     
				                      
  

	</div>
   	   		 
   	    
   </section>
   <!--End Body Part -->

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