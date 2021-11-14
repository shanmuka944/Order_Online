<?php include('partials/menu.php')?>

<?php
//check wether id is set or not
if(isset($_GET['id']))
{
    //get all the details
    $id=$_GET['id'];

    $sql2="SELECT * FROM tbl_food WHERE id=$id";
    $res2=mysqli_query($conn,$sql2);
    //get the value based on query executed
    $row2=mysqli_fetch_assoc($res2);
    //get the indivisual values of food
    $title=$row2['title'];
    $description=$row2['description'];
    $price=$row2['price'];
    $current_image=$row2['image_name'];
    $current_category=$row2['category_id'];
    $featured=$row2['featured'];
    $active=$row2['active'];
}
else
{
    //redirect to manage food
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>

<div class='main-content'>
    <div class='wrapper'>
        Update food
        <br><br>
        <form action="" method='POST' enctype="multipart/form-data">

        <table class='tbl-30'>
        
        <tr>
            <td>
               Title: 
            </td>
            <td>
                <input type='text' name='title' value='<?php echo $title;?>' placeholder='food title'>
            </td>

          </tr>
          <tr>
              <td>Description</td>
              <td>
                  <textarea name='description'  cols='30' rows='5'><?php echo $description;?></textarea>
              </td>
          </tr>
          <tr>
              <td>
                  Price:
              </td>
              <td>
                  <input type='number' value='<?php echo $price;?>' name='price'>
              </td>
          </tr>
          <tr>
              <td>Current Image</td>
              <td>
               <?php
               if($current_image =='')
               {
                 echo "<div class='error'>Image not available</div>";
               }
               else{
                   ?>
                 <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width='130px'>
                 <?php
               }
               ?> 
              </td>
          </tr>
          <tr>
              <td>
                  Select Image
              </td>
              <td>
                 <input type='file' name='image'> 
              </td>
          </tr>
          <tr>
              <td>Category:</td>
              <td>
                  <select name='category'>
                      <?php

                      $sql="SELECT * FROM tbl_category WHERE active='yes'";
                      $res=mysqli_query($conn,$sql);
                      $count=mysqli_num_rows($res);
                      //check wether category available or not
                      if($count>0)
                      {
                         while($row=mysqli_fetch_assoc($res))
                         {
                             $category_title=$row['title'];
                             $category_id=$row['id'];

                             //echo "<option value='$category_id'>$category_title</option>";
                             ?>
                             <option <?php if($current_category==$category_id) echo "selected" ?>value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                             <?php
                         } 
                      }
                      else
                      {
                          echo "<option value ='0'>Category not availabel</option>";
                      }
                      ?>
                      
                      
                  </select>
              </td>
          </tr>
          <tr>
              <td>
                  Featured:
              </td>
              <td>
                  <input <?php if($featured=='yes') {echo "checked";}?> type='radio' name='featured' value='yes'>yes
                  <input <?php if($featured=='no'){echo "checked";}?> type='radio' name='featured' value='no'>no
              </td>
          </tr>
          <tr>
              <td>
                  Active:
              </td>
              <td>
                  <input <?php if($active=='yes'){echo "checked";}?> type='radio' name='active' value='yes'>yes
                  <input <?php if($active=='no'){echo "checked";}?> type='radio' name='active' value='no'>no
              </td>
          </tr>
          <tr>
              <td>
                  <input type='hidden' name='id' value="<?php echo $id;?>">
                  <input type='hidden' name='current_image' value="<?php echo $current_image;?>">
                  <input type="submit" name='submit' value='update-food' class='btn-sec'>
              </td>
          </tr>


        </table>
 
        </form>
        <?php
        //check wether button is clicked or not
        if(isset($_POST['submit']))
        {
            //echo "button clicked";
            //get all the details in form
            $id=$_POST['id'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $current_image=$_POST['current_image'];
            $category=$_POST['category'];
            $featured=$_POST['featured'];
            $active=$_POST['active'];

            //upload the image if selected

            //check wether upload button is clicked or not
            if(isset($_FILES['image']['name']))
            {
               //upload button clicked 
               $image_name=$_FILES['image']['name'];

               //check wether the file is available or not
               if($image_name!='')
               {
                $ext=end(explode(".",$image_name));
                   $image_name="Food-Name".rand(0000,9999).'.'.$ext;
                   $src=$_FILES['image']['tmp_name'];
                   $des="../images/food/".$image_name;
                   $upload=move_uploaded_file($src,$des);
                   if($upload==false)
                   {
                     $_SESSION['uploadimage']="<div class='error'>Failed to 4 upload image</div>";
                     header('location:'.SITEURL.'admin/manage-food.php');
                     die();
                   }
                   //remove current image if available
                   if($current_image!='')
                   {
                       $removepath="../images/food/".$current_image;
                       $remove=unlink($removepath);
                       if($remove==FALSE)
                       {
                        $_SESSION['remove-failed']="<div class='error'>Failed to upload image</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        die();
                       }
                   }
               }
               else{
                   $image_name=$current_image;
               }
            }
            else
            {
                $image_name=$current_image;
            }
            //remove the image if new image is uploaded and current image exists
            //update the database
            $sql3="UPDATE tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id='$category',
            featured='$featured',
            active='$active'
            WHERE id=$id
            ";
            $res3=mysqli_query($conn,$sql3);
            if($res3==TRUE)
            {
                $_SESSION['updated-food']="<div class='sucess'>Food Updated Sucessfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else{
                   
            $_SESSION['updated-food']="<div class='error'>Food not Updated </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            }
            //redirect to manage food with session message
            
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php')?>
