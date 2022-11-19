<?php include("partials-front/menu.php")?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
                 $search=$_POST['search'];
            ?>
            <h2>Foods on your search <?php echo $search?></h2>
        

            
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
            //get the search keyword
            

            //sql query
            $sql= "SELECT * from food where title like '%$search%' OR description like '%$search%'";

            $res=mysqli_query($conn,$sql);

            $count=mysqli_num_rows($res);

            if($res == true)
            {
                // count rows
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    // data present
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
                                    <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
                    echo "<div class='error'>Food not found.</div>";
                }
            }  
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include("partials-front/footer.php"); ?>