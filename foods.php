<?php include("partials-front/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                // 1. query
                $sql = "SELECT *FROM food WHERE active = 'Yes'";
                // 2. execute query
                $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));
                // 3. check whether query executed or not
                if($res == true)
                {
                    // count rows
                    $count = mysqli_num_rows($res);

                    if($count>0)
                    {
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $description = $rows['description'];
                            $price = $rows['price'];
                            $image_name = $rows['image_name'];
                            ?> <!-- PHP breaks -->
                            
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                    
                                        if($image_name == "")
                                        {
                                            // no picture
                                            echo "<div class='error'>No Picture!</div>";
                                        }
                                        else
                                        {
                                            ?><!-- PHP breaks2 -->
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="food-image" class="img-responsive img-curve">
                                            <?php // <!-- PHP starts -->
                                        }
                                    
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo "$".$price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                            <?php //<!-- PHP starts -->
                        }
                    }
                    else
                    {
                        // food are empty
                        echo "<div class='error'>Food not found</div>";
                    }
                }
            ?>


            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include("partials-front/footer.php"); ?>