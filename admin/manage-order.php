<?php include("partials/menu.php"); ?>

        <!-- Main Content Section starts  -->
        <section class="main-content">
            <div class="wrapper">
                <h1>Manage Order</h1>              

                <br>

                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        // 1. query
                        $sql = "SELECT *FROM order ORDER BY id DESC"; // Display the latest order first
                        // 2. execute query
                        $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));
                        // 3. check whether query is executed or not
                        if($res == true)
                        {
                            // count rows
                            $count = mysqli_num_rows($res);
                            $sn = 1;
                            
                            if($count>0)
                            {
                                // order present
                                while($row = mysqli_fetch_assoc($res))
                                {
                                    //Get all the order details
                                    $id = $row['id'];
                                    $food = $row['food'];
                                    $price = $row['price'];
                                    $qty = $row['qty'];
                                    $total = $row['total'];
                                    $order_date = $row['order_date'];
                                    $status = $row['status'];
                                    $customer_name = $row['customer_name'];
                                    $customer_contact = $row['customer_contact'];
                                    $customer_email = $row['customer_email'];
                                    $customer_address = $row['customer_address'];
                                    ?> <!-- PHP breaks -->
                                    <tr>
                                        <td><?php echo $sn++?></td>
                                        <td><?php echo $food?></td>
                                        <td>$<?php echo $price?></td>
                                        <td><?php echo $qty?></td>
                                        <td>$<?php echo $total?></td>
                                        <td><?php echo $order_date?></td>
                                        <td>
                                            <?php 
                                                // Ordered, On Delivery, Delivered, Cancelled

                                                if($status=="Ordered")
                                                {
                                                    echo "<label>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'><b>$status</b></label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'><b>$status</b></label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'><b>$status</b></label>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $customer_name?></td>
                                        <td><?php echo $customer_contact?></td>
                                        <td><?php echo $customer_email?></td>
                                        <td><?php echo $customer_address?></td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id ?>" class="btn-secondary">Update Order</a>                                      
                                        </td>
                                    </tr>
                                    <?php // <!-- PHP starts -->
                                } 
                            }
                            else
                            {
                                // order not present
                                echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                            }
                        }
                    ?>                   
                </table>

            </div>  
            <div class="clearfix"></div>
            
        </section>
        <!-- Main Content Section ends  -->

<?php include("partials/footer.php"); ?>