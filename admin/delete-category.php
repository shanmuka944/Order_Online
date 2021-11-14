<?php 
include('../config/constants.php');
//check wether the id and image_name are set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //get the value and delete
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    echo $id;
    //remove the physical image file if available 
    if($image_name != "")
    {
        //image is available ,so remove it
       $path='../images/category/'.$image_name;
        //remove the image
        $remove=unlink($path);
        //if failed to remove image
        if($remove==FALSE)
        {  
            //share the session message
            $_SESSION['remove']="<div class='error'>Failed to remove image</div>";

            //redirect to manage-category page
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        }
    }

    //delete the data from data base
    $sql="DELETE FROM tbl_category WHERE id=$id";
    $res=mysqli_query($conn,$sql);

    //check wether the data is deleted from database or not
    if($res==TRUE)
    {
        //set the sucess message
        $_SESSION['delete']="<div class='sucess'>Category deleted sucessfully</div>";
        header('location:'.SITEURL.'admin/manage-category.php');

    }
    else
    {
        //set fail message and redirect
        $_SESSION['delete']="<div class='error'>Category not  deleted </div>";
        header('location:'.SITEURL.'admin/manage-category.php');

    }

    //redirect to manage category page with messaage

}
else
{
    //redirect to manage category page
    header('location:'.SITEURL.'admin/manage-category.php');
}

?>