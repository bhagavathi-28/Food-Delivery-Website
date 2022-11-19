<?php include("partials-front/menu.php"); ?>\

<?php

    if(isset($_GET['food_id']))
    {
        $food_id = $_GET['food_id'];

        // 1. Query
        $sql = "SELECT *FROM food WHERE id = $food_id";
        // 2. execute query
        $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));
        // 3. check whether query executed or not
        if($res == true)
        {
            $count = mysqli_num_rows($res);

            if($count == 1)
            {
               // food exist
                $rows = mysqli_fetch_assoc($res);
                
                $title = $rows['title'];
                $price = $rows['price'];
                $image_name = $rows['image_name'];              
            }
            else
            {
                // not exist redirect to index.php
                header('location:'.SITEURL);
            }
        } 
        else
        {
            // redirect on index.php
            header('location:'.SITEURL);
        }
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($image_name == "")
                            {
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                ?> <!-- PHP breaks -->
                                <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name ?>" alt="food-image"  class="img-responsive img-curve">
                                <?php // <!-- PHP starts -->
                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title ?>"> 

                        <p class="food-price"><?php echo "Rs".$price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price ?>"> 

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="99......." class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Street city address" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    // 1. Get all the details from the form
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $qty * $price; // total
                    $order_date = date('Y-m-d h:i:sa'); //2022-08-31 10:10:03pm // order date
                    $status = "Ordered";
                    $customer_name =  $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address']; 

                    // 2. Query to save the order in database
                    $sql2 = "INSERT INTO tbl_order SET
                            food = '$food',
                            price = $price,
                            qty = $qty,
                            total = $total,
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'
                            ";

                    // 3. Execute query
                    $res2 = mysqli_query($conn, $sql2) or die('error'.mysqli_error($conn));
                    
                    // 4. check whether query execute or not
                    if($res2 == true)
                    {
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    } 
                    else
                    {
                        //Failed to Save Order
                        $_SESSION['order'] = "<div class='failure text-center'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include("partials-front/footer.php"); ?>

