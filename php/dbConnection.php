<?php 

 //$connection=mysqli_connect('localhost','devel503_swotta','@%&mU0?T+C1?','devel503_swotta');//Server
//$connection=mysqli_connect('localhost','root','','swottanews'); //Localhost
$connection = mysqli_connect('localhost', 'id1574088_swottaroot', 'arshoma2005', 'id1574088_swotta');//free web hosting

if(!$connection)
{
echo "Database connection Failed ". mysqli_connect_error();
}

?>