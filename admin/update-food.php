<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Food</h2>

        <br> <br>

        <?php
            // Retreive data from DB
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                // 1. Query
                $sql = "SELECT *FROM food WHERE id = $id";

                // 2. Execute Query
                $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));

                // 3. Check whether Query executed or not
                if($res == true)
                {
                    $count = mysqli_num_rows($res);

                    if($count == 1)
                    {
                        // show message that Food Available
                        echo "Food Available";

                        $rows = mysqli_fetch_assoc($res);

                        $id = $rows['id'];
                        $title = $rows['title'];
                        $description = $rows['description'];
                        $price = $rows['price'];
                        $current_image = $rows['image_name'];
                        $current_category = $rows['category_id'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];
                    }
                    else
                    {
                        // session to give error
                        $_SESSION["category-not-found"]= "<div class='error'>Food not found</div>";
                        // redirect to manage food
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        ?>

    <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" value="<?php echo $title ?>">
                </td>
            </tr>

            <tr>
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5" ><?php echo $description ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image</td>
                <td>
                    <?php 
                        if($current_image != "")
                        {
                            ?> 
                            <img src="<?php echo SITEURL?>images/food/<?php echo $current_image?>" alt="" width="100px">
                            <?php 
                        } 
                        else
                        {
                            echo "<div class='error'>Image Not Added</div>";
                        }
                            
                    ?>
                </td>
            </tr>

            <tr>
                <td>Select Image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">
                        <?php
                            // Query
                            $sql2 = "SELECT *FROM category WHERE active = 'Yes'";
                            // execute Query
                            $res = mysqli_query($conn, $sql2) or die('error'.mysqli_error($conn));
                            // check whether Query execute or not
                            if($res == true)
                            {
                                // count rows
                                $count = mysqli_num_rows($res);

                                if($count > 0)
                                {
                                    while($rows = mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $rows['title'];
                                        $category_id = $rows['id']; ?>

                                        <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "<option value='0'>No Category Available</option>";
                                }
                                
                            }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured == 'Yes'){echo "checked" ;} ?> type="radio" name="featured" id="featured_yes" value="Yes"> 
                    <label for="featured_yes">Yes</label>

                    <input <?php if($featured == 'No'){echo "checked" ;} ?> type="radio" name="featured" id="featured_no" value="No"> 
                    <label for="featured_no">No</label>
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active == 'Yes'){echo "checked" ;} ?> type="radio" name="active" id="active_yes" value="Yes"> 
                    <label for="active_yes">Yes</label>

                    <input <?php if($active == 'No'){echo "checked" ;} ?> type="radio" name="active" id="active_no" value="No"> 
                    <label for="active_no">No</label>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                </td>
            </tr>

        </table>

    </form> 
    </div>
</div>

<!-- Here we update the food -->
<?php
    if(isset($_POST['submit']))
    {
        // echo "Btn Clicked";

        // 1. get all the details from the form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //2. Upload the image if selected
        if(isset($_FILES['image']['name']))
        {
            $image_name= $_FILES['image']['name'];

            if($image_name!="")
            {
                // image available
                
                // Upload the new image
                // Auto rename our image
                // get the extension of our image (jpg, png, gif, etc) e.g. "specialfood.jpg"
                $tmp = explode('.', $image_name);
                $ext= end($tmp); // end is used to get value after the '.'

                // Rename the image
                $image_name = "Food-Name-".rand(0000,9999).".".$ext;

                $source_path= $_FILES['image']['tmp_name'];

                $destination_path= "../images/food/".$image_name;

                // finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                // check whether the image is upload or not
                // and if the image is not upload then we will stop the process and redirect with error message
                if($upload==false)
                {
                    // set message 
                    $_SESSION['upload']= "<div class='failure'>Failed to Update Food Image!</div>";
                    // redirect to add category page
                    header('location:'.SITEURL.'admin/manage-food.php');
                    // stop the process 
                    die();
                }

                // 3. remove the current image
                if($current_image!="")
                {
                    $remove_path= "../images/food/".$current_image;
                    $remove= unlink($remove_path);   // now $remove have boolean value yes or no 
                
                    // if failed to remove image then add an error message and end the process
                    if($remove==false)
                    {
                        // set the session message
                        $_SESSION['failed-remove']= "<div class='failure'>Failed to Remove Food Image</div>";
                        // redirect to Manage category page 
                        header('location:'.SITEURL.'admin/manage-food.php');
                        // stop the process
                        die();
                    }
                }
            } 
            else
            {
                $image_name= $current_image;
            }
        } 
        else
        {
            $image_name= $current_image;
        }

        //4. Update the Food in Database
        $sql3 = "UPDATE food SET 
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
                ";

        //5. Execute the SQL Query
        $res3 = mysqli_query($conn, $sql3) or die("error".mysqli_error($conn));

        //6. CHeck whether the query is executed or not 
        if($res3==true)
        {
            //Query Exectued and Food Updated
            $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Failed to Update Food
            $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
?>

<?php include("partials/footer.php"); ?>