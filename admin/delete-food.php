<?php
include('../config/constants.php');
if(isset($_GET['id'])&&isset($_GET['image_name']))
{
    //process to delete
    //echo "process to delete";

    //get id and image name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];


    //remove the image
    //check wether the image available or not and then delete if available
    if($image_name != '')
    {
        //it has image and need to remove from folder
        //get the image path
        $path="../images/food/".$image_name;
        //remove file from folder
        $remove=unlink($path);

        if($remove=FALSE)
        {
            $_SESSION['uploadfailed']="<div class='error>Failed to remove image</div>";
            header('location'.SITEURL.'admin/manage-food.php');
            die(); 
        }
        
    }

    //delete food from database

    $sql="DELETE FROM tbl_food WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    //check wether the query is executed or not and set the session message
    if($res==TRUE)
    {
        $_SESSION['deletefood1']="<div class='sucess'>Food deleted Successfully </div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else{
        $_SESSION['deletefood1']="<div class='error'>Failed to delete Food</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

    //redirect to manage food with session message
}
else
{
    //redirect to manage food page
   //echo "redirect";
   $_SESSION['deletefood']="<div class='error'>UnAthourized Acess</div>";
   header('location:'.SITEURL.'admin/manage-food.php');
}

?>