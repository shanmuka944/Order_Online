<?php include('partials/menu.php'); ?>

<div class='main-content'>
    <div class='wrappper'>
       <h1>Add Category </h1><br><br>

       <?php 
       if(isset($_SESSION['add']))
       {
           echo $_SESSION['add'];
           unset($_SESSION['add']);
       }
       if(isset($_SESSION['upload']))
       {
           echo $_SESSION['upload'];
           unset($_SESSION['upload']);
       }
       ?>
       <!--add category form-->
       <form action='' method='POST' enctype='multipart/form-data' >
          <table class='tbl-30'>
             <tr>
                 <td>Title:</td>
                 <td>
                     <input type='text' name='title' placeholder='category title'>
                </td>
            </tr>
            <tr>
                <tr>
                    <td>
                      Select Image  
                    </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
              <td>Featured:</td>
              <td>
                  <input type='radio' name='featured' value='yes'>yes
                  <input type='radio' name='featured' value='no'>no
              </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                <input type='radio' name='active' value='yes'>yes
                  <input type='radio' name='active' value='no'>no
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                  <input type='submit' name='submit' value='Add Category' class='btn-sec'>
                </td>
            </tr>
          </table>
       </form> 
       <?php 
       //check wether the submit button is clicked
       if(isset($_POST['submit']))
       {
          // echo 'clicked';
          //get the value from form category form
          $title=$_POST['title'];

          //for radio input type we need to check wether the button is selected or not 
          if(isset($_POST['featured']))
          {
                  //get the featured value 
                  $featured=$_POST['featured'];
          }
          else
          {
              //set the default value
              $featured='no';
          }
          if(isset($_POST['active']))
          {
                  //get the featured value 
                  $active=$_POST['active'];
          }
          else
          {
              //set the default value
              $active='no';
          }
          //check wether the image is selected or not and set the value for image name accordingly
          if(isset($_FILES['image']['name']))
          {
              //upload the image
              //to upload image we need image name ,source path,destination path
              $image_name=$_FILES['image']['name'];
               if($image_name !='')
               {
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
                  $_SESSION['upload']="<div class='error'>Image not Uploaded</div>";
                  header('location:'.SITEURL.'admin/add-category.php');
                  //stop the process
                  die();
              }
               }
              
          }
          else
          {
            //dont upload the image and set the image value as blank
            $image_name='';
          }

          //create sql query to insert category into database
          $sql="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";
            //execute the query and save in database
            $res=mysqli_query($conn,$sql);
            //check wether the query executed or not
            if($res==TRUE)
            {
                //query executed and category added
               $_SESSION['add']="<div class='sucess'>Category Added Successfully</div>"; 
               //redirect to manage category page
               header('location:'.SITEURL.'admin/manage-category.php');

            }
            else{
                //failed to add category
                $_SESSION['add']="<div class='error'>Category Not Added</div>"; 
               //redirect to manage category page
               header('location:'.SITEURL.'admin/add-category.php');

            }    

       }
      
       ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>
