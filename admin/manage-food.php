<?php include("partials/menu.php"); ?>

        <!-- Main Content Section starts  -->
        <section class="main-content">
            <div class="wrapper">
                <h1>Manage Food</h1>
                <br>
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['unauthorize'])){
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['category-not-found'])){
                        echo $_SESSION['category-not-found'];
                        unset($_SESSION['category-not-found']);
                    }

                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['failed-remove'])){
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                ?>
                <br/><br/>
                
                <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>

                <br/><br/><br/>

                <table class="tbl">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        // 1. Query to retrieve data from database
                        $sql = "SELECT *FROM food";

                        // 2. Execute Query to retrieve data
                        $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));

                        // 3. Check whether Query is executed or not
                        if($res == true)
                        {
                            $count = mysqli_num_rows($res);
                            $sn = 1;

                            if($count>0)
                            {
                                while($rows = mysqli_fetch_assoc($res))
                                {
                                    $id = $rows['id'];
                                    $title = $rows['title'];
                                    $description = $rows['description'];
                                    $price = $rows['price'];
                                    $image_name = $rows['image_name'];
                                    $featured = $rows['featured'];
                                    $active = $rows['active'];

                                    // Display value in Table
                                    ?> <!-- PHP breaks -->

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $description; ?></td>
                                        <td><?php echo "Rs".$price; ?></td>
                                        <td> 
                                            <?php
                                                if($image_name != "")
                                                {
                                                    ?> <!-- PHP breaks 2 -->
                                                    <!-- http://localhost/food-order/images/food/$image_name -->
                                                    <img src="<?php echo SITEURL?>images/food/<?php echo $image_name; ?>" alt="" width="100px">
                                                    
                                                    <?php //<!-- PHP starts 2 -->
                                                }
                                                else
                                                {
                                                    //Display the message
                                                    echo "<div class='failure'>Image Not Added</div>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <!-- Actions -->
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                            
                                        </td>
                                    </tr>
                                    <?php // <!-- PHP Starts -->
                                }
                            }
                            else
                            {
                                // No Data in database
                                ?> <!-- PHP Breaks 3 -->
                                
                                <tr>
                                    <td colspan="8" class="error text-center">No Category Added.</td>
                                </tr>
                                
                                <?php // <!-- PHP Starts 3 -->
                                
                            }
                        }
                    ?>
                </table>

            </div>  
            <div class="clearfix"></div>
            
        </section>
        <!-- Main Content Section ends  -->

<?php include("partials/footer.php"); ?>