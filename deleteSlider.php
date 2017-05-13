<?php
    include_once('php/dbConnection.php');
    include_once('php/allFunctions.php');
    
    ob_start();
        session_start();
        
         if(!isset($_SESSION['email']) || !isset($_SESSION['admin'])){
            header("Location:php/error.php");
        }

	   $id =  $_REQUEST['id'];
	
    global $connection ;
        
	  $queryLink="SELECT * from slider where id='$id'";
    $result=mysqli_query($connection,$queryLink);
    $row=mysqli_fetch_assoc($result);
    $link=$row['link'];
    $query = "DELETE FROM slider WHERE id='$id'";

    mysqli_query($connection, $query);
    if(file_exists($link))
    unlink($link);

     $contents=getAllSlider();

    while ($row=mysqli_fetch_assoc($contents)) {
                                     printf("<tr>");
                                      printf('<td>
                                         <span>%s</span> </td>'

                                         ,$row['description']);

                                       printf('<td>
                                        <div class="image_position">
                                          

                                          <img src="%s" class="img img-responsive image_size_compression" >


                                        </div>
                                        </td>',$row['link']);

                                      printf('<td>
                                                              <span class="pull-right">
                                        <a type="button" class ="btn btn-primary" href="sliderDetails.php?sid=%s">Edit </a>
                                         <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#%sconfirmDeleteS" data-title="Delete User" data-message="Are you sure you want to delete this contents ?">Delete </button>
                                       </span>
                                        </td>

                                        </tr>

                                        <div class="modal fade" id="%sconfirmDeleteS" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
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
                                                    
                                                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="confirm"  onclick=deleteSliderS(\'%s\')>Delete</button>
                                                 </div>
                                              </div>
                                            </div>
                                          </div>

                                        ',$row['id'], $row['id'],$row['id'], $row['id']);
                                     //print("</tr>");
                                  }

?>
