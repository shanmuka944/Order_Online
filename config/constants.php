
<?php
  //start session
 session_start();

 //$site_url="http://localhost/ORDER_ONLINE/";
  define('SITEURL',"http://localhost/ORDER_ONLINE/");
  //create constants to store non repeating values
 $conn=mysqli_connect('localhost','root','') or die(mysqli_error());
 $db_select=mysqli_select_db($conn,'order-online') or die(mysqli_error());



 ?>