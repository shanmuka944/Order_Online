<?php include('partials/menu.php')?>
<div class='main-content'>
    <div class='wrapper'>
       <h1>Manage Food</h1>

       <br><br>
       <?php
       if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['deletefood']))
        {
            echo $_SESSION['deletefood'];
            unset($_SESSION['deletefood']);
        }
        if(isset($_SESSION['uploadfailed']))
        {
            echo $_SESSION['uploadfailed'];
            unset($_SESSION['uploadfailed']);
        }
        if(isset($_SESSION['deletefood1']))
        {
            echo $_SESSION['deletefood1'];
            unset($_SESSION['deletefood1']);
        }
        if(isset($_SESSION['uploadimage']))
        {
            echo $_SESSION['uploadimage'];
            unset($_SESSION['uploadimage']);
        }
        if(isset($_SESSION['remove-failed']))
        {
            echo $_SESSION['remove-failed'];
            unset($_SESSION['remove-failed']);
        }
        if(isset($_SESSION['updated-food']))
        {
            echo $_SESSION['updated-food'];
            unset($_SESSION['updated-food']);
        }

        
        
        ?>
        <br>
        <br> 
        <a href='<?php  echo SITEURL;?>admin/add-food.php' class='btn-primary'>Add Food </a>
        <br><br><br>
        <table class='tbl-full' >
           <tr>
              <th>S.NO</th>
              <th>Title</th>
              <th>Price</th>
              <th>Image</th>
              <th>Featured</th>
              <th>Active</th>
              <th>Actions</th>
           </tr>
           <?php
           //create sql query to get all the food
           $sql="SELECT * FROM tbl_food";
           $res=mysqli_query($conn,$sql);
           $count=mysqli_num_rows($res);
           $sn=1;
           if($count>0)
           {
              
             
              while( $row=mysqli_fetch_assoc($res))
             {
                $id=$row['id'];
                $title=$row['title'];
                $price=$row['price'];
                $image_name=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
                ?>
                <tr>
              <td><?php echo $sn++;?></td>
              <td><?php echo $title;?></td>
              <td><?php echo $price;?></td>
              <td><?php 
              if($image_name=='')
              {
                 echo "<div class='error>Image not given</div>";

              }
              else{
                 ?>
                 <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>"width='100px'>
                 <?php
              }
              ?></td>
              <td><?php echo $featured;?></td>
              <td><?php echo $active;?></td>
              <td><a href='<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id?>' class='btn-sec'>Update Food </a>
              <a href='<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>' class='btn-danger'>Delete Food </a>
              </td>
                </tr>
          


                <?php
             }

           }
           else{
              echo "<tr> <td colspan='7' class='error' >Food not added yet</td></tr>";
           }
           ?>

           
        </table>
        
    </div>
   
</div>

<?php include('partials/footer.php')?>



