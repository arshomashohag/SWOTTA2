<?php

function getAboutContents(){
	$result = getAbout();
    $flag = false;

	while ($about = mysqli_fetch_assoc($result)) {
		$flag=true;

		 printf('

		 	<tr>
		 	  <td>%s</td>

		 	  <td>

		 	     <a class="btn btn-primary" href="editabout.php?id=%s">
		 	     Edit</a>
		 	     <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#%sconfrmDelabout" data-title="Delete User" data-message="Are you sure you want to delete this contents ?">Delete </button>

		 	  </td>

		 	  <div class="modal fade" id="%sconfrmDelabout" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
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
                                                    
                                                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="confirm"  onclick=deleteAbout(\'%s\')>Delete</button>
                                                 </div>
                                              </div>
                                            </div>
                                          </div>

		 	</tr>
		 	', br2nl($about['about']), $about['id'], $about['id'], $about['id'], $about['id']);
	}
	if(!$flag){
		printf('<tr><td>No content yet!! Add content soon.</td></tr>');
	}
}



?>

