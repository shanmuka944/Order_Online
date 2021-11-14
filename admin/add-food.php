<?php include('partials/menu.php');?>
<div class='main-content'>
    <div class='wrapper'>
        <h1>Add Food</h1>
        <br><br>
        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        ?>
        <form action="" method='POST' enctype='multipart/form-data'>

          <table class='tbl-30'>
              <tr>
                  <td>
                      Title:
                  </td>
                  <td>
                      <input type='text' name='title' placeholder='enter title'>
                  </td>
              </tr>
              <tr>
                  <td>Description:</td>
                  <td>
                      <textarea name='description' col='30' rows='5' placeholder='description of food'></textarea>
                  </td>
              </tr>
              <tr>
                  <td>
                      Price
                  </td>
                  <td>
                      <input type='number' name='price' >
                  </td>
              </tr>
              <tr>
                  <td>Select image</td>
                  <td>
                      <input type='file' name='image'>
                  </td>
              </tr>
              <tr>
                  <td>Category:</td>
                  <td>
                      <select name='category'>
                          <?php
                          //create php code to display categories from database
                          //sql query to get all active categories
                          $sql="SELECT * FROM tbl_category WHERE active='yes'";
                          $res=mysqli_query($conn,$sql);
                          $count=mysqli_num_rows($res);
                          if($count>0)
                          {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the deatils
                                $id=$row['id'];
                                $title=$row['title'];
                                ?>
                                <option value="<?php echo $id;?>"><?php echo $title;?></option>

                                <?php
                            }
                          }
                          else
                          {
                             ?>
                             <option value="0">No category found</option>
                             <?php
                          }
                          //display on dropdown

                          ?>
                          
                      </select>
                  </td>
              </tr>
              <tr>
                  <td>Featured</td>
                  <td>
                      <input type="radio" name='featured' value='yes'>yes
                      <input type="radio" name='featured' value='no'>no
                  </td>
              </tr>
              <tr>
                  <td>Active</td>
                  <td>
                      <input type="radio" name='active' value='yes'>yes
                      <input type="radio" name='active' value='no'>no
                  </td>
                  <tr>
                      <td colspan='2'>
                          <input type="submit" name='submit' value='add-food' class='btn-sec'>
                      </td>
                  </tr>
              </tr>
          </table>

        </form>

       <?php
       if(isset($_POST['submit']))
       {
           //add the food in data base
           $title=$_POST['title'];
           $description=$_POST['description'];
           $price=$_POST['price'];
           $category=$_POST['category'];

           if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else{
                $featured='no';
            }
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else{
                $active='no';
            }
            if(isset($_FILES['image']['name']))
            {
                $image_name=$_FILES['image']['name'];
                if($image_name!= "")
                {
                    $ext=end(explode(".",$image_name));
                    //create new name for image
                    $image_name="food-Name".rand(0000,9999).".".$ext;
                    $src=$_FILES['image']['tmp_name'];
                    $des="../images/food/".$image_name;
                    $upload=move_uploaded_file($src,$des);
                    if($upload==false)
                    {
                        //failed to upload image
                        //redirect to add food with err msg
                        //stop process
                        $_SESSION['upload']="<div class='error'>image not uploaded</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        die();
                    }
                }

            }
            else
            {
                $image_name='';
            }
            //insert into database
           $sql2="INSERT INTO tbl_food SET 
           title='$title',
           description='$description',
           price=$price,
           image_name='$image_name',
           category_id=$category,
           featured='$featured',
           active='$active'
           ";
           $res2=mysqli_query($conn,$sql2);
           if($res2==TRUE)
           {
            $_SESSION['add']="<div class='sucess'>Food Added Sucessfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
           }
           else{
            $_SESSION['add']="<div class='sucess'>Food not Added</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
           
       }
       ?>



    </div>
</div>

<?php include('partials/footer.php');?>
