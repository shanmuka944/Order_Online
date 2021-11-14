<?php include('partials/menu.php'); ?>

<div class='main-content'>
     <div class='wrapper'>
         <h1>Update Admin</h1><br><br>
         <?php 
         //get the id of selected admin
          $id=$_GET['id'];
         //create sql query to get details
         $sql="SELECT * FROM tbl_admin WHERE id=$id";
         //execute the query
         $res=mysqli_query($conn,$sql);
         //check wether the query is executed or not
         if($res==TRUE)
         {
             //check wether is available or not
             $count=mysqli_num_rows($res);
             //check wether we have admin data or not
             if($count==1)
             {
                 //get the details
                 $row=mysqli_fetch_assoc($res);
                 $fullname=$row['full_name'];
                 $username=$row['username'];

             }
             else
             {
                 //redirect to manage-admin page
                 header('location'.SITEURL.'admin/manage-admin.php');
             }
         }
         ?>
         <form action='' method='post'>
             <table class='tbl-30'>
                <tr>
                    <td>Full Name</td>
                    <td>
                     <input type='text' name='full_name' value='<?php echo $fullname; ?>'>
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                     <input type='text' name='username' value='<?php echo $username;?>'>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                      <input type='hidden' name='id' value='<?php echo $id; ?>' >
                      <input type='submit' name='submit' value='update admin' class='btn-sec'>

                    </td>
                </tr>
             </table>
         </form>
     </div>
</div>
<?php 
  //check wether the submit button is clicked or not
  if(isset($_POST['submit']))
  {
       //echo button clicked;
       //get all the values from form to update
       $id=$_POST['id'];
       $full_name=$_POST['full_name'];
       $username=$_POST['username'];

       //create sql query to update admin
       $sql="UPDATE tbl_admin SET
       full_name='$full_name',
       username='$username'
       WHERE id=$id";

       //execute the query

       $res=mysqli_query($conn,$sql);

       //check wethr the query executed successfully or not
       if($res==TRUE)
       {
           //query executed and admin updated
           $_SESSION['update']="<div class='sucess'>Admin Updated Sucessfully</div>";
           header('location:'.SITEURL.'admin/manage-admin.php');
       }
       else
       {
        $_SESSION['update']="<div class='error'>Admin  not Updated </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
       }
  
  }
?>


<?php include('partials/footer.php'); ?>