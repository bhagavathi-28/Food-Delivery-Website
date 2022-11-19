<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Update Category</h2>

        <br> <br>

        <?php
        // Retrieve data from db & show them in fields
            if(isset($_GET['id'])){
                $id= $_GET['id'];

                // sql query
                $sql= "SELECT *FROM category WHERE id= $id";

                // execute sql query 
                $res= mysqli_query($conn, $sql) or die("error".mysqli_error($conn));

                // check whether the query is executed or not
                if($res==true){
                    $count= mysqli_num_rows($res);

                    if($count==1){
                        // show message that Admin Available
                        echo "Category Available";
                        
                        $rows= mysqli_fetch_assoc($res);

                        $id= $rows['id'];
                        $title= $rows['title'];
                        $current_image= $rows['image_name'];
                        $featured= $rows['featured'];
                        $active= $rows['active'];

                    } else{
                        // session to give error
                        $_SESSION["category_not_found"]= "<div class='error'>Category not  found</div>";
                        // redirect to manage category
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Current Image</td>

                        <td>
                            <?php 
                                if($current_image != ""){
                                    ?> 
                                    <img src="<?php echo SITEURL?>images/category/<?php echo $current_image?>" alt="" width="100px">
                                    <?php 
                                } else{
                                    echo "<div class='error'>Image Not Added</div>";
                                }
                            
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image" >
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
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>                       
        </form>
    </div>
</div>

<!-- Now update the data -->

<?php 
    if(isset($_POST['submit'])){
        // 1. get all values from the form
        $id= $_POST['id'];
        $title= $_POST['title'];
        $current_image= $_POST['current_image'];
        $featured= $_POST['featured'];
        $active= $_POST['active'];

        // 2. updating the image if selected 
        if(isset($_FILES['image']['name'])){
            $image_name= $_FILES['image']['name'];

            if($image_name!=""){
                // image available
                
                // Upload the new image
                // Auto rename our image
                // get the extension of our image (jpg, png, gif, etc) e.g. "specialfood.jpg"
                $ext= end(explode('.', $image_name)); // end is used to get value after the '.'

                // Rename the image
                $image_name= "Food_Category_".$title."_".rand(0, 999).".".$ext; // e.g: Food_Category455.jpg

                $source_path= $_FILES['image']['tmp_name'];

                $destination_path= "../images/category/".$image_name;

                // finally upload the image
                $upload= move_uploaded_file($source_path, $destination_path);

                // check whether the image is upload or not
                // and if the image is not upload then we will stop the process and redirect with error message
                if($upload==false){
                    // set message 
                    $_SESSION['upload']= "<div class='error'>Failed to Update Image!</div>";
                    // redirect to add category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                    // stop the process 
                    die();
                }

                // remove the current image
                if($current_image!=""){
                    $remove_path= "../images/category/".$current_image;
                    $remove= unlink($remove_path);   // now $remove have boolean value yes or no 
                
                    // if failed to upload image then add an error message and end the process
                    if($remove==false){
                        // set the session message
                        $_SESSION['failed-remove']= "<div class='error'>Failed to Remove Category Image</div>";
                        // redirect to Manage category page 
                        header('location:'.SITEURL.'admin/manage-category.php');
                        // stop the process
                        die();
                    }
                }
                
            } 
            else{
                $image_name= $current_image;
            }
        } 
        else{
            $image_name= $current_image;
        }

        // 3. update the database
        $sql2= "UPDATE category 
                SET title= '$title',
                image_name = '$image_name',
                featured= '$featured',
                active= '$active' 
                WHERE id= $id ";

        $res2= mysqli_query($conn, $sql2) or die("error".mysqli_error($conn));

        if($res2==true){
            // Session start 
            $_SESSION['update']= "<div class='success'>Category Updated Successfully!</div>";
            // Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        } else{
            // Session start 
            $_SESSION['update']= "<div class='error'>Failed to Update Category!</div>";
            // Redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        // 4. Redirect to category with message

    }

?>

<?php include('partials/footer.php'); ?>