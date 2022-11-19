<?php include("partials-front/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php 
                if(isset($_GET['category_id']))
                {
                    //Category id is set and get the id
                    $category_id = $_GET['category_id'];
                    // Get the CAtegory Title Based on Category ID
                    $sql = "SELECT title FROM category WHERE id=$category_id";

                    //Execute the Query
                    $res = mysqli_query($conn, $sql);

                    //Get the value from Database
                    $row = mysqli_fetch_assoc($res);
                    //Get the TItle
                    $category_title = $row['title'];
                }
                else
                {
                    header('location:'.SITEURL);
                } 
            ?>
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php                                
                // 1. query 
                $sql = "SELECT *FROM food WHERE category_id = '$category_id'";
                // 2. execute query
                $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));
                // 3. check whether query executed or not
                if($res == true)
                {
                    // count rows
                    $count = mysqli_num_rows($res);

                    if($count>0)
                    {
                        // food present
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $description = $rows['description'];
                            $price = $rows['price'];
                            $image_name = $rows['image_name']; 

                            ?> <!-- PHP Break -->
                            
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                <?php 
                                    if($image_name == "")
                                    {
                                        // no picture
                                        echo "<div class='error'>No Picture!</div>";
                                    }
                                    else
                                    {   ?> <!-- PHP Breaks -->
                                        <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name; ?>" alt="food_image" class="img-responsive img-curve">
                                        <?php //<!-- PHP Starts -->
                                    }
                                ?>
                                </div>
                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>
                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                            <?php //<!-- PHP Starts -->
                        }
                    }
                    else
                    {
                        //Food Not Available
                        echo "<div class='error' style='font-size:150% ; text-align: center; margin: 10% 0%'>Food Not Found</div>";
                    }
                } 
            ?>
            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include("partials-front/footer.php"); ?>