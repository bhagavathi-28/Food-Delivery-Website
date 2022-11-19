<?php include("partials-front/menu.php"); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                // 1. Query
                $sql = "SELECT *FROM category WHERE active = 'Yes'";
                // 2. execute query
                $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));
                // 3. check whether query executed or not
                if($res == true)
                {   
                    // count rows in sql
                    $count = mysqli_num_rows($res);
                    
                    if($count>0)
                    {
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
                            
                            ?> <!-- PHP breaks -->
                            <a href="<?php echo SITEURL?>category-foods.php?category_id=<?php echo $id?>">
                                <div class="box-3 float-container">

                                <?php
                                    if($image_name == "")
                                    {
                                        echo "<div class='error'>Image Not Available</div>";
                                    }
                                    else
                                    {
                                        ?> <!-- PHP breaks2 -->
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php // <!-- PHP starts2 -->
                                    }
                                ?>
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                            <?php // <!-- PHP starts -->
                        }
                    }
                    else
                    {
                        // empty tables category
                        echo "<div class='error'>Category not found</div>";
                    }
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


<?php include("partials-front/footer.php"); ?>