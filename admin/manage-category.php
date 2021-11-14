<?php include('partials/menu.php')?>
<div class='main-content'>
    <div class='wrapper'>
       <h1>Manage Category</h1>
       <br><br><br>
       <?php 
       if(isset($_SESSION['add']))
       {
           echo $_SESSION['add'];
           unset($_SESSION['add']);
       }
       if(isset($_SESSION['remove']))
       {
           echo $_SESSION['remove'];
           unset($_SESSION['remove']);
       }
       if(isset($_SESSION['delete']))
       {
           echo $_SESSION['delete'];
           unset($_SESSION['delete']);
       }
       if(isset($_SESSION['category-not-found']))
       {
           echo $_SESSION['category-not-found'];
           unset($_SESSION['category-not-found']);
       }
       if(isset($_SESSION['upd']))
       {
           echo $_SESSION['upd'];
           unset($_SESSION['upd']);
       }
       if(isset($_SESSION['upl']))
       {
           echo $_SESSION['upl'];
           unset($_SESSION['upl']);
       }
       if(isset($_SESSION['failed-remove']))
       {
           echo $_SESSION['failed-remove'];
           unset($_SESSION['failed-remove']);
       }
       
       
       ?>
        <br><br>
        <a href='<?php echo SITEURL;?>admin/add-category.php' class='btn-primary'>Add Category </a>
        <br><br><br>
        <table class='tbl-full' >
           <tr>
              <th>S.NO</th>
              <th>Title</th>
              <th>Image</th>
              <th>Featured</th>
              <th>Active</th>
              <th>Actions</th>
           </tr>
           <?php 
              $sql="SELECT * FROM tbl_category";
              //execute query
              $res=mysqli_query($conn,$sql);

              //count rows
              $count=mysqli_num_rows($res);

              if($count>0)
              {
                 $sn=1;
                 //we have data 
                 //get the data and display
                while($row=mysqli_fetch_assoc($res))
                {
                   $id=$row['id'];
                   $title=$row['title'];
                   $image_name=$row['image_name'];
                   $featured=$row['featured'];
                   $active=$row['active'];
                   ?>
                    <tr>
                      <td><?php echo $sn++?></td>
                      <td><?php echo $title?></td>

                      <td>
                         <?php
                         //check wether image name is available or not
                         if($image_name!='')
                         {
                            ?>
                            
                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" width='100px'>
                           <?php
                           }

                         else
                         {
                            echo 'No image given';
                         }
                         ?>
                     </td>

                      <td><?php echo $featured?></td>
                      <td><?php echo $active?></td>
                      <td><a href='<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?> 'class='btn-sec'>Update Category </a>
                      <a href='<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ?>' class='btn-danger'>Delete Category </a>
                      </td>
                     </tr>
           

                   <?php
                } 
              }
              else{
                 //we dont have data
                 //we wil display the message inside table
                 ?>
                 <tr>
                    <td>
                       <div colspan='6' class='error'>
                         no category added
                       </div>
                    </td>
                 </tr>
                 <?php
              }
           ?>
          
           </tr>
        </table>
        
    </div>
   
</div>

<?php include('partials/footer.php')?>



