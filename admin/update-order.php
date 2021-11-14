<?php include('partials/menu.php');?>

<div class='main-content'>
    <div class='wrapper'>
        <h1>Update Order</h1>
        <br><br>
        <?php
       //check wether id is set or not
       if(isset($_GET['id']))
       {
           //get the order details
           $id=$_GET['id'];
           //Sql query to get order details
           $sql="SELECT * FROM tbl_order WHERE id=$id";
           //execute query
           $res=mysqli_query($conn,$sql);
           //count 
           $count=mysqli_num_rows($res);
           if($count>0)
           {
               $row=mysqli_fetch_assoc($res);
              

                 //$id=$row['id'];
                 $food=$row['food'];
                 $price=$row['price'];
                 $qty=$row['qty'];
                 $total=$row['total'];
                 $order_date=$row['order_date'];
                 $status=$row['status'];//ordered or on delivery or cancel
                 $customer_name=$row['customer_name'];
                 $customer_contact=$row['customer_contact'];
                 $customer_email=$row['customer_email'];
                 $customer_address=$row['customer_address'];

           }
           else
           {
            header('location:'.SITEURL.'admin/manage-order');
           }
       }
       else
       {
           //redirect to manage order
           header('location:'.SITEURL.'admin/manage-order');
       }

        ?>

        <form action="" method="POST">
          
         <table class='tbl-30'>


         
          <tr>
              <td>
                  Food Name
              </td>
              <td>
               <b><?php echo $food;?></b>
              </td>
          </tr>
          <tr>
              <td>QTY</td>
              <td>
                  <input type='number' name='qty' value='<?php echo $qty;?>'>
              </td>
          </tr>
          <tr>
              <td>Status</td>
              <td>
                  <select name='status' >
                   <option <?php if($status=='Ordered'){echo "selected";}?> value='Ordered'>Ordered</option> 
                   <option <?php if($status=='On Delivery'){echo "selected";}?> value='On Delivery'>On Delivery</option>
                   <option <?php if($status=='Delivered'){echo "selected";}?> value='Delivered'>Delivered</option>
                   <option <?php if($status=='Cancelled'){echo "selected";}?> value='Cancelled'>Cancelled</option>     
                  </select>
              </td>
          </tr>
          <tr>
              <td colspan='2'>
                  <input type="hidden" name='id'value='<?php echo $id;?>' >
                  <input type='submit'  name='submit' value='update order' class='btn-sec '>
              </td>
          </tr>
          </table>
          
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            //get all the values from form
              $id=$_POST['id'];
              $qty=$_POST['qty'];
              $status=$_POST['status'];
            //update the values
            $sql2="UPDATE tbl_order SET
                  qty=$qty,
                  status='$status'
                  WHERE id=$id
            ";
            $res2=mysqli_query($conn,$sql2);


            //and redirect to manage ordered
            if($res2==TRUE)
            {
                $_SESSION['updateorder1']="<div class='sucess'>Order Updated Sucessfully</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
            else
            {
                $_SESSION['updateorder1']="<div class='error'>Order Not  Updated </div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
            
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>
