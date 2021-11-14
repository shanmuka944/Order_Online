<?php include('partials/menu.php');?>



<div class='main-content'>
    <div class='wrapper'>
       <h1>Update Category</h1>

       <br><br>
       <?php
         //check wether the id is set or not
         if(isset($_GET['id'])){
         //get the id and all other details
         //echo 'getting the data';
          $id=$_GET['id'];
          //create sql query to get all other details
          $sql="SELECT * FROM tbl_category WHERE id=$id ";
          //execute the query
          $res=mysqli_query($conn,$sql);
          //count the rows
          $count=mysqli_num_rows($res);
          if($count==1)
          {
              //we will get all the data
              $row=mysqli_fetch_assoc($res);
              $title=$row['title'];
              $current_image=$row['image_name'];
              $featured=$row['featured'];
              $active=$row['active'];
          }
          else
          {
              //redirect to manage category with session message
              $_SESSION['category-not-found']="<div class='error'>category not found</div>";
              header('location:'.SITEURL.'admin/manage-category.php');
          }

          }
         else{
          //redirect to manage category
          header('location:'.SITEURL.'admin/manage-category.php');
         }

        ?>
       <form action='' method='POST' enctype='multipart/form-data'>
       <table class='tbl-30'>
          <tr>
              <td>
               Title:
              </td>
              <td>
                  <input type='text' name='title' value='<?php echo $title ;?>'>
              </td>
             </tr>
             <tr>
                <td>
                    Current Image:
                </td>
                <td>
                    <?php 
                    if($current_image != '')
                    {
                        //display the image
                        ?>
                        <img src='<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>' width='130px'>;
                        <?php
                    }
                    else
                    {
                        //display message
                        echo "<div class='error'>Image not given</div>";
                    }
                    ?>
                </td>
              </tr>
              <tr>
                  <td>New Image:</td>
                  <td>
                      <input type='file' name='image'>
                  </td>
              </tr>
              <tr>
                  <td>Featured:</td>
                  <td>
                    <input <?php if($featured=='yes'){echo "checked";}?> type='radio' name='featured' value='yes'>yes
                    <input <?php if($featured=='no'){echo " checked";}?> type='radio' name='featured' value='no'>no

                  </td>
              </tr>
              <tr>
                  <td>Active:</td>
                  <td>
                    <input <?php if($active=='yes'){echo "checked";}?> type='radio' name='active' value='yes'>yes
                    <input <?php if($active=='no'){echo "checked";}?> type='radio' name='active' value='no'>no

                  </td>
              </tr>
              <tr>
                  <td>
                  <input type='hidden' name='current_image' value='<?php echo $current_image;?>'>
                  <input type='hidden' name='id' value='<?php echo $id;?>'>
                  <input type='submit' name='submit' value='update-category' class='btn-sec'>
                  </td>
              </tr>
       </table>
       </form>
       <?php
       if(isset($_POST['submit']))
       {
           //echo 'clicked';
           //get all the values from the form 
           $id=$_POST['id'];
           $title=$_POST['title'];
           $current_image=$_POST['current_image'];
           $featured=$_POST['featured'];
           $active=$_POST['active'];

           //updating the new image if selected
           //check wether the image is selected or not
           if(isset($_FILES['image']['name']))
           {
               //get the image details
               $image_name=$_FILES['image']['name'];
               //check wether the image is available or not
               if($image_name != "")
               {
                   //image available
                   //upload the new image
                   //auto rename the image
              $ext=end(explode('.',$image_name));
              //rename the image
              $image_name='food_category_'.rand(000,999).'.'.$ext;
              
              $source_path=$_FILES['image']['tmp_name'];
              $destination_path='../images/category/'.$image_name;
              //upload the image
              $upload=move_uploaded_file($source_path,$destination_path);
              //check wether the image is uploaded
              //if the image is not uploaded we will stop the process and redirect with error page
              if($upload==FALSE)
              {
                  $_SESSION['upl']="<div class='error'>Image not Uploaded</div>";
                  header('location:'.SITEURL.'admin/manage-category.php');
                  //stop the process
                  die();
              }
                   if(current_image != "")
                   {
                        //remove the current image
                   $remove_path="../images/category/".$current_image;
                   $remove=unlink($remove_path);
                    //check wether the image is removed or not
                    if($remove==FALSE)
                    {
                        //failed to remove image
                        $_SESSION['failed-remove']="<div class='error'>failed to remove current image</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                        die();
                    }
                   }
                   
               }
               else
               {
                   $image_name=$current_image;
               }
           }
           else
           {
               $image_name=$current_image;
           }
           
           //update the database
           $sql2="UPDATE tbl_category SET
           title='$title',
           image_name='$image_name',
           featured='$featured',
           active='$active' 
           WHERE id=$id
           ";
           //execute the query
           $res2=mysqli_query($conn,$sql2);
           //redirect to manage category with message
           if($res2==TRUE)
           {
             $_SESSION['upd']="<div class='sucess'>Category updated sucessfully</div>";
             header('location:'.SITEURL.'admin/manage-category.php');

           }
           else
           {
            $_SESSION['upd']="<div class='error'>Category  not updated </div>";
            header('location:'.SITEURL.'admin/manage-category.php');

           }

       }
       ?>
    </div>
</div>

<?php include('partials/footer.php');?>