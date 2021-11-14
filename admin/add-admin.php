<?php include('partials/menu.php');?>

  <div class='main-content'>
      <div class='wrapper'>
         <h1>
             Add Admin
         </h1><br><br>
         <?php   
        if(isset($_SESSION['add']))
        {
           echo ($_SESSION['add']);
           unset($_SESSION['add']);
        }
        ?><br><br><br>
         <form action='' method='post'>
           <table class='tbl-30'>
               <tr>
                   <td>Full Name:</td>
                   <td><input type='text' name='full_name' placeholder='enter your name'></td>
                   <td></td>

               </tr>
               <tr>
                   <td>User Name:</td>
                   <td><input type='text' name='username' placeholder='enter your username'></td>
                   <td></td>

               </tr>
               <tr>
                   <td>Password:</td>
                   <td><input type='password' name='password' placeholder='enter your password'></td>
                   <td></td>
               </tr>
               <tr>
                  <td col-span='2'>
                      <input type="submit" name="submit" value='Add Admin' class='btn-sec' >
                  </td>
               </tr>
           </table>
         </form>
      </div>
  </div>

<?php include('partials/footer.php');?>
<?php 
//process the value from form to database
//check wether the button is cliclked or not
if(isset($_POST['submit'])){
    //button clicked
    //echo('button clicked');
     
    //get the data from form 
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=$_POST['password'];//password encryption

    //sql query to  save data into database
   $SQL = "INSERT INTO tbl_admin SET 
   full_name='$full_name',
   username='$username',
   password='$password'
   ";
      //executing query 
       $res=mysqli_query($conn,$SQL) or die(mysqli_error());
       //check wether the data is inserted or not
       if($res==TRUE)
       {
           //echo DATA INSERTED;
           $_SESSION['add']='Admin Added Successfully';
           header("location:".SITEURL.'admin/manage-admin.php');
       }
       else {
        $_SESSION['add']='Admin Not Added';
        header("location:".SITEURL.'admin/add-admin.php');
       }
      
}
?>




