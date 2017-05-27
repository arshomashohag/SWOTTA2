<?php 
include "dbConnection.php";
	
	function signin_checking($email, $password){

	    global $connection;
       //Admin checking
       $pass=sha1($password);
       $query = "SELECT * FROM admin WHERE email='$email' AND password='$pass'";
       $result = mysqli_query($connection, $query);

       if(mysqli_num_rows($result)==1){
            return "admin";
       }

         //User checking 
		      $error=false;
          $msg="";
		       
         $email = mysqli_real_escape_string($connection,$email);
         $password = mysqli_real_escape_string($connection,$password);

         if(empty($email)){
                
                return "Please enter your  username.";

            }


            if (empty($password)){
                 
                return "Please enter password.";
            }

             
            	  $hashFormat = "$2y$10$";
                $salt = "iusesomecrazystrings22";
                $hashF_and_salt = $hashFormat . $salt;
                $password = crypt($password, $hashF_and_salt);
                $query = "SELECT * from users where email='$email'";
                $query_email_result = mysqli_query($connection,$query);
                $row=mysqli_fetch_assoc($query_email_result);
                $count_user =mysqli_num_rows($query_email_result);

                   if($count_user==1 && $row['password']==$password){
                            
                            return $row['id'];
                            
                      }
              else  return "Wrong username or password, Try again...";
                       

                        
	}



	function registration($name, $email, $password, $confirm_password)
	{
		// Signup form action is here
    global $connection;
        $error=false;
        
        
        $email = mysqli_real_escape_string($connection,$email);
        $password = mysqli_real_escape_string($connection,$password);
		$confirm_password = mysqli_real_escape_string($connection,$confirm_password);
          // check username exist or not

            if(empty($email)){
                $error=true;
                $emailError = "Please enter your  email.";

            }
            else {

                $query = "SELECT email from users where email='$email'";
                $query_email_result = mysqli_query($connection,$query);
                $check_email =mysqli_num_rows($query_email_result);
                if($check_email!=0){
                    
                    return "Provided Email is already in use.";
                }

            }

      // password validation
          if (empty($password)){
              
             return "Please enter password.";
          } else if(strlen($password) < 6) {
               
              return "Password must have atleast 6 characters.";
          }
        if (empty($confirm_password)){
            
            return "Please retype password.";
        } else if($password != $confirm_password) {
             
            return "Password does not match";
        }

             



                        $hashFormat = "$2y$10$";
                        $salt = "iusesomecrazystrings22";
                        $hashF_and_salt = $hashFormat . $salt;
                        $password = crypt($password, $hashF_and_salt);
                        $query="INSERT INTO users(name, email, password)";
                        $query.="values('$name','$email','$password')";
                        $query_insert_result = mysqli_query($connection,$query);

                        if($query_insert_result)
                        {

                            return "You Are Successfully Registered !! Please Log In Now.";
                        }
                        else
                        {
                            
                            return "Something went wrong, try again later...";
                        }
 
	}


  function addAdmin($email, $password, $conf, $name){
    global $connection;
    $query = "SELECT * FROM admin where email='$email'";
    $result = mysqli_query($connection, $query);

    
    if($password!=$conf){
      return "Password don't match !!";
    }

    if(mysqli_num_rows($result)>=1){
      return "Already assigned as an admin !";
    }

    
    $password = sha1($password);

    $query = "INSERT INTO admin(email, password, name) VALUES('$email', '$password', '$name')";
    $result = mysqli_query($connection, $query);

    if($result){
      return "Admin registered successfully !!";
    }
    else{
      return "Something wrong, please try again !";
    }

  }


  function changeAdminPass($email, $old, $new, $newcof){
    global $connection;

    if($new!=$newcof){
      return "Password don't match!!";
    }


    $pass = sha1($old);
    $newpass = sha1($new);
    $query = "SELECT * FROM admin WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result)==1){
           if($old == $new){
          return "Password same as old password, pick a new one!";
        }
      $query = "UPDATE admin SET password='$newpass' WHERE email='$email'";
      $result = mysqli_query($connection, $query);

      if($result){
        return "Password changed successfully!!";
      }
      return "Something went wrong, please try again !";
    }

    return "Wrong old password !!";
  }


  function getAllArticle($name){

    global $connection;
    $query = "SELECT * FROM $name";

    $result = mysqli_query($connection, $query);
    return $result;
  }



  function getArticleExtra($id,$name){

    global $connection;
    $query = "SELECT * FROM $name where id='$id'";

    $result = mysqli_query($connection, $query);
    if(!$result)
      echo "Failed";
    return $result;
  }

function updateArticle($id, $title, $filepath, $filetmp, $article,$tableName)
  {
                  global $connection;
                          $zerro=0;
                            
                           $filepath = mysqli_real_escape_string($connection,$filepath);

                       

                           $query="UPDATE $tableName SET  head='$title',";

                           if(!empty($filepath)){
                            $query.="image='$filepath',";
                           }

                           $query.="body='$article' WHERE id='$id'";


                           $result = mysqli_query($connection, $query);
                           if($result){
                            move_uploaded_file($filetmp, $filepath);
                            }
                            else
                                return $result;
                        
                          

                          return true;

  }

  function getAllCategory(){

    global $connection;

    $query = "SELECT 
    c.id,
    c.name,
    sc.id,
    sc.name
    FROM category as c left outer join subcategory as sc 
    on c.id=sc.cid";


    $result = mysqli_query($connection, $query);

    while($row=mysqli_fetch_assoc($result)){

    }

  }

  function getCategory(){
    global $connection;
    $query = "SELECT * FROM category";

    $result = mysqli_query($connection, $query);

    return $result;
  }


  function getSubCategory($cid){
    global $connection;
    $query = "SELECT 
    sc.id,
    sc.name
    FROM subcategory as sc where sc.cid='$cid'";

    $result = mysqli_query($connection, $query);

    return $result;
  }

  function addSubcategory($name,$cid)
  {

    global $connection;
    $query = "SELECT * FROM subcategory WHERE name='$name'";
    $result = mysqli_query($connection,$query);

   
    if(mysqli_num_rows($result)==0){
       $query = "INSERT into subcategory(cid,name) values('$cid','$name')";
       $result = mysqli_query($connection,$query);

       if(!$result){
        return "Something wrong ! Please try again !";
       }

       return "Subcategory Added Successfully!!";
       
    }
    else{
      return "Subcategory already exist ! Add new one.";
    }

  
  }

  function updateContentes($id, $title, $filepath, $filetmp, $article)
  {
                  global $connection;
                          $zerro=0;
                            
                           $filepath = mysqli_real_escape_string($connection,$filepath);

                       

                           $query="UPDATE content SET  head='$title',";

                           if(!empty($filepath)){
                            $query.="image='$filepath',";
                           }

                           $query.="body='$article', readcount='$zerro' WHERE id='$id'";


                           $result = mysqli_query($connection, $query);
                           if($result){
                            move_uploaded_file($filetmp, $filepath);
                            }
                            else
                                return $result;
                        
                          

                          return true;

  }


  function getAllContents($cid){

    global $connection;
    $query = "SELECT * FROM content WHERE cid='$cid'";

    return mysqli_query($connection, $query);

  }

  function getAllContentsBySearch($text){
    $array = preg_split("/[\s,]+/", $text);

    global $connection;
    $query ="SELECT * FROM content WHERE ";


    $chk = 1;
    foreach ($array as $value) {

      if($chk>1){
       $query.='OR body LIKE \'%'.$value.'%\' ';
      }

      else{
        $query.= 'body LIKE \'%'.$value.'%\' ';
      }

     $query.='OR head LIKE \'%'.$value.'%\' ';

      $chk++;

    }
   //return $query;
    return mysqli_query($connection, $query);
     
  }


  function getAllcontentsDetails($id){
    global $connection;
    $query = "SELECT * FROM content WHERE id='$id'";

    return mysqli_query($connection, $query);
  }


  function getContents($cid, $scid){
    global $connection;
    $query = "SELECT * FROM content WHERE cid='$cid' AND scid='$scid' ORDER BY createdat DESC";

    return mysqli_query($connection, $query);
  }


  function getSpecific($pid){

     global $connection;
    $query = "SELECT * FROM content WHERE id='$pid'";

    return mysqli_query($connection, $query);

  }


  function addContentes($category_id, $subcategory_id, $title, $filepath, $filetmp, $article){ 
                      
                          global $connection;
                          $zerro=0;
                           // $filetmp = mysqli_real_escape_string($connection,$filetmp);
                           $filepath = mysqli_real_escape_string($connection,$filepath);
                        

                           $query="INSERT INTO content (cid, scid, head, image, body, readcount) VALUES('$category_id','$subcategory_id','$title','$filepath','$article', '$zerro')";

                           $result = mysqli_query($connection, $query);
                           if($result && !empty($filepath) && !empty($filetmp)){
                            move_uploaded_file($filetmp, $filepath);
                            }
                            
                           
                          
                            if(!$result)
                              return $result;

                          return true;
                          
                    }


 function checkCountImage(){
      global $connection;
       $query = "SELECT * FROM photon ";
       $result=mysqli_query($connection, $query);
       $row= mysqli_fetch_assoc($result);
       $count= $row['count'];  
       $old=$count;
       $count=$count+1;
       $queryU="UPDATE photon SET count='$count' WHERE id=1";
       mysqli_query($connection,$queryU);
       return $old;

 } 


function addNewArticle($title, $article,  $filepath, $filetmp){

  global $connection;

  $query = "INSERT INTO article (head, body, image) VALUES('$title','$article','$filepath')";

  $result = mysqli_query($connection, $query);

  if($result && strlen($filepath)>0){
    move_uploaded_file($filetmp, $filepath);
    return true;
  }

  if(!$result)
    return false;

  return true;

}


function addNewEditorial($title, $editorial,  $filepath, $filetmp){
     global $connection;

  $query = "INSERT INTO editorial (head, body, image) VALUES('$title','$editorial','$filepath')";

  $result = mysqli_query($connection, $query);

  if($result && strlen($filepath)>0){
    move_uploaded_file($filetmp, $filepath);
    return true;
  }

  if(!$result)
    return false;

  return true;
}


function addDeskNews($title, $editorial,  $filepath, $filetmp){
    global $connection;

    $time = date("Y-m-d H:i:s");

  $query = "INSERT INTO desk (head, body, image, createdat) VALUES('$title','$editorial','$filepath', '$time')";

  $result = mysqli_query($connection, $query);

  if($result && strlen($filepath)>0){
    move_uploaded_file($filetmp, $filepath);
    return true;
  }

  if(!$result)
    return false;

  return true;
}



function addImagetoGallery($description, $filepath, $filetmp){

  global $connection;

  $query = "INSERT INTO gallery (head, image) VALUES('$description', '$filepath')";

  $result = mysqli_query($connection, $query);

  if($result && strlen($filepath)>0){
    move_uploaded_file($filetmp, $filepath);
    return true;
  }

  if(!$result)
    return false;

  return true;

}



function getIndividualGalleryContents($id){
    global $connection;
    $query = "SELECT * FROM gallery where id='$id' ";

    return mysqli_query($connection, $query);

}

function getAllGallery(){
  global $connection;
    $query = "SELECT * FROM gallery";

    return mysqli_query($connection, $query);

}



function updategallery($id, $head, $filepath, $filetmp){

                  global $connection;
                          $zerro=0;
                           $check=0; 
                           $filepath = mysqli_real_escape_string($connection,$filepath);

                          $contents = getIndividualGalleryContents($id); 
                          $row=mysqli_fetch_assoc($contents);
                          $link=$row['image'];

                           $query="UPDATE gallery SET  head='$head',";

                           if(!empty($filepath)){
                            $query.="image='$filepath',";
                            $check=1;

                           }

                           $query.="type=0 WHERE id='$id'";


                           $result = mysqli_query($connection, $query);
                           if($result && $check==1) {
                            move_uploaded_file($filetmp, $filepath);
                            if(file_exists($link))
                            {
                              unlink($link);
                            }
                            }
                            else
                                return $result;
                        
                          

                          return true;


}


  function updateSlider($id, $head, $filepath, $filetmp){
                          global $connection;
                          $zerro=0;
                           $check=0; 
                           $filepath = mysqli_real_escape_string($connection,$filepath);

                          $contents = getIndividualSliderContents($id); 
                          $row=mysqli_fetch_assoc($contents);
                          $link=$row['link'];

                           $query="UPDATE slider SET description='$head',";

                           if(!empty($filepath)){
                            $query.="link='$filepath',";
                            $check=1;

                           }

                           $query.="type=0 WHERE id='$id'";


                           $result = mysqli_query($connection, $query);
                           if($result && $check==1) {
                                move_uploaded_file($filetmp, $filepath);
                                if(file_exists($link))
                                {
                                  unlink($link);
                                }
                                }
                            else
                                return $result;
                        
                          

                          return true;
    }

 function getAllSlider(){
    global $connection;
    $query = "SELECT * FROM slider";

    return mysqli_query($connection, $query);
 }
function getIndividualSliderContents($id){
    global $connection;
    $query = "SELECT * FROM slider where id='$id' ";

    return mysqli_query($connection, $query);
}


function addImagetoSlider($description, $filepath, $filetmp){
   global $connection;

  $query = "INSERT INTO slider (description, link, type) VALUES('$description', '$filepath', 0)";

  $result = mysqli_query($connection, $query);

  if($result && strlen($filepath)>0){
    move_uploaded_file($filetmp, $filepath);
    return true;
  }

  if(!$result)
    return false;

  return true;
}

function addImageforAdd($description, $filepath, $filetmp){

   global $connection;

  $query = "INSERT INTO addimage (description, link) VALUES('$description', '$filepath')";

  $result = mysqli_query($connection, $query);

  if($result && strlen($filepath)>0){
    move_uploaded_file($filetmp, $filepath);
    return true;
  }

  if(!$result)
    return false;

  return true;
}



function updateAdvertisemnt($id, $head, $filepath, $filetmp){

                  global $connection;
                          $zerro=0;
                           $check=0; 
                           $filepath = mysqli_real_escape_string($connection,$filepath);

                          $contents = getIndividualAdvertisementContents($id); 
                          $row=mysqli_fetch_assoc($contents);
                          $link=$row['link'];

                           $query="UPDATE addimage SET  description='$head',";

                           if(!empty($filepath)){
                            $query.="link='$filepath',";
                            $check=1;

                           }

                           $query.="type=0 WHERE id='$id'";


                           $result = mysqli_query($connection, $query);
                           if($result && $check==1) {
                            move_uploaded_file($filetmp, $filepath);
                            if(file_exists($link))
                            {
                              unlink($link);
                            }
                            }
                            else
                                return $result;
                        
                          

                          return true;

}
 function getIndividualAdvertisementContents($id){

  global $connection;
    $query = "SELECT * FROM addimage where id='$id' ";

    return mysqli_query($connection, $query);
 }

function getAllAdvertisement(){
  global $connection;
    $query = "SELECT * FROM addimage";

    return mysqli_query($connection, $query);

}


function getAllExtra($tablename, $pid=null){
  global $connection;

  $query = "SELECT * FROM ".$tablename;
  if(isset($pid)){
    $query.= " WHERE id='$pid'";
  }

  return mysqli_query($connection, $query);
}


function updateReadCount($pid){

  global $connection;

  $query = "SELECT readcount FROM content WHERE id='$pid'";

  $result = mysqli_query($connection, $query);

  $data = mysqli_fetch_assoc($result);

  $readcount = $data['readcount'] + 1;

  $query = "UPDATE content SET readcount='$readcount' WHERE id='$pid'";

  mysqli_query($connection, $query);

}

function getPopular(){
  global $connection;

  $query = "SELECT * FROM content ORDER BY readcount DESC";

  return mysqli_query($connection, $query);
  
}


function getAllMessages(){
  global $connection;

  $query = "SELECT * FROM messages ORDER BY sentat DESC";

  return mysqli_query($connection, $query);
}



function getAbout($id=null)
{
  global $connection;
  if(isset($id)){
      $check = "SELECT * FROM abouts WHERE id='$id'";
    }

  else{
   $check="SELECT * FROM abouts ORDER BY createdat DESC";
 }
    return mysqli_query($connection,$check);
     
}

function updateAbout($id, $about){
  global $connection;

  $query = "UPDATE abouts SET about='$about' WHERE id='$id' ";
  mysqli_query($connection, $query);

  return mysqli_affected_rows($connection);
}

function deleteAboutContent($id){
  global $connection;

  $query = "DELETE FROM abouts  WHERE id='$id' ";
  mysqli_query($connection, $query);

  return mysqli_affected_rows($connection);
}

 function add_about_swotta($about)
 {
         global $connection;        
         $query="INSERT INTO abouts (about) values('$about')";

         $result=mysqli_query($connection,$query);       
         return $result;
 }

 function getContactsInfo()
{
  global $connection;
   $query="SELECT * FROM contactinfos";
   $result = mysqli_query($connection,$query);
   return $result;
}

function getFeatures()
{
  global $connection;
   $query="SELECT * FROM about_feature ORDER BY createdat DESC";
   $result = mysqli_query($connection,$query);
   return $result;
}

 function add_contact_info($address, $email , $mobile)
 {

   global $connection;
   $check="SELECT * FROM contactinfos ";
   $check_result = mysqli_query($connection,$check);
   $row=mysqli_fetch_assoc($check_result);
   $a=$row['address'];
   $b=$row['email'];
   $c=$row['mobile'];
   $address=mysqli_real_escape_string($connection,$address);
   $email=mysqli_real_escape_string($connection,$email); 
   $mobile=mysqli_real_escape_string($connection,$mobile);
   
   if(empty($a) && empty($b) && empty($c))
      {
         
         $query="INSERT INTO contactinfos (address,email,mobile) values('$address','$email','$mobile')";
         $result=mysqli_query($connection,$query);
        
      }
      else
      {

        $query="UPDATE contactinfos SET address='$address',email='$email',mobile='$mobile' where id=0";
        $result=mysqli_query($connection,$query);
       
      }
      return $result;
 }


function  getIndividualFeature($id){


     global $connection;
    $query = "SELECT * FROM about_feature WHERE id='$id'";

    return mysqli_query($connection, $query);

}

function  updateFeature($title,$body,$id){
     global $connection;
        $query="UPDATE about_feature SET title='$title',body='$body' where id='$id'";
       return $result=mysqli_query($connection,$query); 
}
function add_feature($title,$body)
 {

   global $connection;
   
   $title=mysqli_real_escape_string($connection,$title);
   $body=mysqli_real_escape_string($connection,$body); 

   $query="INSERT INTO about_feature (title,body) values('$title','$body')";
   $result=mysqli_query($connection,$query);
     
      return $result;
 }

 

?>
