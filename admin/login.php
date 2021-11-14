<?php include('../config/constants.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Order-Onilne System</title>
    <link rel='stylesheet' href='../css/admin.css'>
</head>
<body>
    <div class='login'>
       <h1 class='text-center'>
           Login
       </h1><br>
       <?php 
       if(isset($_SESSION['login']))
       {
           echo $_SESSION['login'];
           unset($_SESSION['login']);
       }
       if(isset( $_SESSION['no-login-message']))
       {
           echo  $_SESSION['no-login-message'];
           unset( $_SESSION['no-login-message']);
       }
       ?><br><br>
       <!---login form -->
       <form action='' method='POST' >
        Username:<br>
        <input type='text' name='username' placeholder='enter username'><br><br>
        Password:<br>
        <input type='password' name='password' placeholder='enter password'><br><br>
        <input type='submit' name='submit' value='login' class='btn-primary'><br><br>
       </form>

       <p class='text-center'>
           Created by -<a href='www.shanmuka.com'>Shanmuka Srinivas</a>

       </p>
    </div>
</body>
</html>
<?php 
//check wether the button is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //get data from login form
    $username=$_POST['username'];
    $password=$_POST['password'];
    //sql to check wether the user exists with given username and password
    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //executing the sql query
    $res=mysqli_query($conn,$sql);

    //count rows to check wether the user exists or not
    $count=mysqli_num_rows($res);
    if($count==1)
    {
        //login success
        $_SESSION['login']="<div class='sucess'>Login Successfull </div>";
        $_SESSION['user']=$username;
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        $_SESSION['login']="<div class='error'>Login not Successfull </div>";
        header('location:'.SITEURL.'admin/login.php');
    }
    

}

?>