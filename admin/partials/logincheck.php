<?php 

//authourization or accesscontrol
//check wether the user is logged in or not
if(!isset($_SESSION['user']))
{
    //user is not logged in
    //redirect to login page with a message
    $_SESSION['no-login-message']="<div class='error'>you have been logged out </div>";
    //redirect to login page
    header('location:'.SITEURL.'admin/login.php');
}


?>