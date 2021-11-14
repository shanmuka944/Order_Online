
<?php 

include('../config/constants.php');

// get the id of the admin to be deleted
 $id=$_GET['id'];
//create sql query to delete admin
$sql="DELETE FROM tbl_admin WHERE id=$id";
//redirect to manage-admin page with message
$res=mysqli_query($conn,$sql);
//check wether the query executed succesfully or not
if($res==TRUE)
{
    //query executed successfully and admin deleted
   // echo "ADMDIN DELETED";
   //create session variable to display message
   $_SESSION['delete']="<div class='sucess'>admin deleted sucessfully</div>";
   header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    //failed to delete admin
    $_SESSION['delete']="<div class='error'>admin not deleted</div>";
    header('location:'.SITEURL.'admin/add-admin.php');
}

?>