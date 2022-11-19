<?php 
    // include constants.php file here
    include('partials/constants.php');

    // check whether the id & name is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 1. Remove the physical image from folder
        if($image_name != "")
        {
            $path = "../images/food/".$image_name;
            $remove = unlink($path); // now $remove have boolean value yes or no 

            if($remove == false)
            {
                // set the session message
                $_SESSION['remove'] = "<div class='error'> Failed to Remove Food Image </div>";
                // redirect to Manage food page 
                header('location:'.SITEURL.'admin/manage-food.php');
                // stop the process
                die();
            }
        }

        // 2. Query to delete data from database
        $sql = "DELETE FROM food WHERE id = $id";

        // 3. Execute Query
        $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));

        // 4. Check whether the Query execute or not
        if($res == true)
        {
            // set the session message
            $_SESSION['delete'] = "<div class='success'> Food Deleted Successfully! </div>";
            // redirect 
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            // set the session message
            $_SESSION['delete'] = "<div class='error'> Failed to Delete Food </div>";
            // redirect 
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else
    {
        // set the session message
        // echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'> Unauthorize Access </div>";
        // redirect 
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>
