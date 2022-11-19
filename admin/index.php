<?php include('partials/menu.php'); ?>

        <!-- Main Content Section starts  -->
        <section class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1> <br>

                <?php
                    if(isset($_SESSION['login'])){  
                        echo $_SESSION['login'];
                        unset($_SESSION['login']); 
                    }
                ?>
                
                <br>
                
                <div class="col-4 text-center">                    
                    <?php
                        $sql = "SELECT *FROM category ";
                        $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br/>
                    Category
                </div>

                <div class="col-4 text-center">
                    <?php
                        $sql = "SELECT *FROM food";
                        $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br/>
                    Food
                </div>
                
                <!--<div class="col-4 text-center">
                    <?php
                        $sql = "SELECT *FROM order";
                        $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br/>
                    Total Orders
                </div>
                
                <div class="col-4 text-center">
                    <?php
                        //Creat SQL Query to Get Total Revenue Generated
                        //Aggregate Function in SQL
                        $sql = "SELECT SUM(total) AS Total FROM order WHERE status='Delivered'";

                        //Execute the Query
                        $res = mysqli_query($conn, $sql);

                        //Get the Value
                        $row5 = mysqli_fetch_assoc($res);
                        
                        //Get the Total Revenue
                        $total_revenue = $row5['Total'];
                    ?>
                    <h1>$<?php echo $total_revenue; ?></h1>
                    <br/>
                    Revenue Generated
                </div>

            </div>  -->
            <div class="clearfix"></div>
            
        </section>
        <!-- Main Content Section ends  -->

<?php include('partials/footer.php'); ?>  
        