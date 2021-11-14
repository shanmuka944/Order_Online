<?php include('partials/menu.php'); ?>

    <!--MAIN CONTENT SECTION STARTS--->
    <div class='main-content'>
       <div class="wrapper">
        <h1>Manage Admin</h1>
        <br><br><br>
        <table class='tbl-full'>
         <tr>
              <th>ID</th>
              <th>Full Name</th>
              <th>Username</th>
              <th>Actions</th>
           </tr>
        <?php   
        if(isset($_SESSION['add']))
        {
           echo ($_SESSION['add']);
           unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete']))
        {
           echo $_SESSION['delete'];
           unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update']))
        {
         echo ($_SESSION['update']);
         unset($_SESSION['update']);
        }
        ?><br><br><br>
        <a href='add-admin.php' class='btn-primary'>Add Admin </a>
        <br><br><br>
           
           <?php 
           $sql="SELECT * FROM tbl_admin";
           $res=mysqli_query($conn,$sql);
           if($res==TRUE)
           {
              //count rows wether we have entries in database
              $count=mysqli_num_rows($res);
              $sn=1;
              //check no of rows
              if($count>0)
              {
                 while($rows=mysqli_fetch_assoc($res))
                 {
                    //using while loop to get all the data from database
                    $id=$rows['id'];
                    $full_name=$rows['full_name'];
                    $username=$rows['username'];
                    ?>
                     
                        
                        <tr class='tbl-full'>
                        <td><?php echo $sn++ ?> </th>
                        <td><?php echo $full_name ?> </th>
                        <td><?php echo $username ?> </th>
                        <td>
                         
              <a href='<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>' class='btn-sec'>Update Admin </a>
              <a href='<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>' class='btn-danger'>Delete Admin </a>
              </td>
                        
                     </tr>
                     <?php
                 }
              }
              else{

              }
           }
           ?>
           
        </table>
        
        
       </div>
    </div>
    <!--MAIN CONTENT SECTION ENDS--->
      
    <?php include('partials/footer.php'); ?>