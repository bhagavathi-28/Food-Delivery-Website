
<?php include("partials-front/menu.php"); ?>

    <!-- food search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- food search Section Ends Here -->
    <br>
    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                // 1. Query
                $sql = "SELECT * FROM category WHERE featured = 'Yes' AND active = 'Yes' LIMIT 3";
                // 2. execute query
                $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));
                // 3. check whether query execute or not
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
                            $image_name = $rows['image_name'];
                            ?> <!-- PHP Breaks  -->
                            
                            <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name == "")
                                        {
                                            echo "<div class='failure'>Image Not Available</div>";
                                        }
                                        else
                                        {
                                            ?> <!-- PHP Breaks 2  -->
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">            
                                            <?php //<!-- PHP Starts 2  -->
                                        }
                                    ?>
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
  
                            <?php //<!-- PHP Starts  -->
                            
                        }
                    }
                    else
                    {
                        // Empty table category 
                        echo "<div class='error'>Category not found</div>";
                    }
                }
            ?>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                // 1. query
                $sql = "SELECT *FROM food WHERE featured = 'Yes' AND active = 'Yes' LIMIT 6";
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
                                            echo "<div class='failure'>No Picture!</div>";
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
                                    <p class="food-price"><?php echo "Rs".$price; ?></p>
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

        <p class="text-center">
            <a href="<?php echo SITEURL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include("partials-front/footer.php"); ?>

    