<?php include('partials-front/menu.php');?>

<?php
//check wether food id is set or not
if(isset($_GET['food_id']))
{
    //get the food id and details of the selected food
    $food_id=$_GET['food_id'];
    //get the details of the slected food
    $sql="SELECT * FROM tbl_food WHERE id='$food_id'";
    //execute the query
    $res=mysqli_query($conn,$sql);
    //count the rows
    $count=mysqli_num_rows($res);
    //check wether data is available or not
    if($count>0)
    {
        //we have data
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];
    }
    else
    {
        header('location:'.SITEURL);
    }

}
else
{
    //redirect to homepage
    header('location:'.SITEURL);
}


?>
<?php
$image_name1=$_GET['image_name'];
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method='POST' class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        //check wether image is available or not
                        if($image_name='')
                        {
                            //image not available
                            echo "<div class='error'>Image not available</div>";
                        }
                        else {
                            ?>
                            
                           <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name1;?>" alt="<?php echo $image_name1;?>" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type='hidden' name='food' value='<?php echo $title;?>'>
                        <input type="hidden" name='price' value='<?php echo $price;?>'>
                        <p class="food-price"><?php echo $price;?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Shanmuka Srinivas" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 7654xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. segu@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
         
            <?php
            //check wether submit button is clicked or not
            if(isset($_POST['submit']))
            {
              //get all the details from the form
              $food=$_POST['food'];
              $price=$_POST['price'];
              $qty=$_POST['qty'];
              $total=$price*$qty;
              $order_date=date("y-m-d h:i:sa" );
              $status="ORDERED";//ordered or on delivery or cancel
              $customer_name=$_POST['full-name'];
              $customer_contact=$_POST['contact'];
              $customer_email=$_POST['email'];
              $customer_address=$_POST['address'];

              //save the order in database
              $sql2="INSERT INTO tbl_order SET 
                      food='$food',
                      price=$price,
                      qty=$qty,
                      total=$total,
                      order_date='$order_date',
                      status='$status',
                      customer_name='$customer_name',
                      customer_contact='$customer_contact',
                      customer_email='$customer_email',
                      customer_address='$customer_address'
                      ";
                      //execute the query
                      $res2=mysqli_query($conn,$sql2);
                      //check wether executed or not
                      if($res2==TRUE)
                      {
                          //query executed
                          $_SESSION['order']="<div class='sucess'>Food Ordered Sucessfully</div>";
                          header('location:'.SITEURL);
                      }
                      else
                      {
                        //query NOT  executed
                        $_SESSION['order']="<div class='error'>Food Not Ordered </div>";
                        header('location:'.SITEURL);
                      }
            }
            ?>




        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>