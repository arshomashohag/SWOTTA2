<?php
include_once('dbConnection.php');

function getIndexSlider(){

	global $connection;

	$query = "SELECT * FROM slider WHERE type=0";

	$result = mysqli_query($connection, $query);

	return $result;

}

function getSubCategoryByScid($scid){
	global $connection;

	$query = "SELECT name FROM subcategory WHERE id='$scid'";
	return mysqli_query($connection, $query);
}


function getCategoryByCid($cid){

	global $connection;

	$query = "SELECT name FROM category WHERE id='$cid'";
	return mysqli_query($connection, $query);

}

function getFromAround(){
	global $connection;

	$query = "SELECT * FROM content WHERE cid=1 ORDER BY createdat DESC";

	$result = mysqli_query($connection, $query);

	 return $result;
}


function getArticle(){
	global $connection;

	$query = "SELECT * FROM article ORDER BY createdat DESC";

	$result = mysqli_query($connection, $query);

	 return $result;
}

function getGallery(){

	global $connection;

	$query = "SELECT * FROM gallery WHERE type=0 ORDER BY createdat DESC";

	$result = mysqli_query($connection, $query);

	 return $result;

}

function getTechnews(){
	global $connection;

	$query = "SELECT * FROM content WHERE cid=4 ORDER BY createdat DESC";

	$result = mysqli_query($connection, $query);

	 return $result;
}

function getDesk(){
	global $connection;

	$query = "SELECT * FROM desk ORDER BY createdat DESC";

	$result = mysqli_query($connection, $query);

	 return $result;
}

function getEditorial(){
	global $connection;

	$query = "SELECT * FROM editorial ORDER BY createdat DESC";

	$result = mysqli_query($connection, $query);

	 return $result;
}


function getAdvertisement(){
	global $connection;

	$query = "SELECT * FROM addimage WHERE type=0";

	$result = mysqli_query($connection, $query);
    $ret=array();
    $i=0;

	  while ($row=mysqli_fetch_assoc($result)) {
	  	 $ret[$i]=$row;
	  	 $i++;
	  }

	  return $ret;
}

?>