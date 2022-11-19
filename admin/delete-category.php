
<?php 

// include constants.php file here
include('partials/constants.php');

    // check whether the id & image_name is set or not
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        // get the value and image 
        $id= $_GET['id'];
        $image_name= $_GET['image_name'];

        // 1. Remove the physical image from folder
        if($image_name != ""){
            $path= "../images/category/".$image_name;
            $remove= unlink($path);   // now $remove have boolean value yes or no 
            
            // if failed to upload image then add an error message and end the process
            if($remove==false){
                // set the session message
                $_SESSION['remove']= "<div class='failure'>Failed to Remove Category Image</div>";
                // redirect to Manage category page 
                header('location:'.SITEURL.'admin/manage-category.php');
                // stop the process
                die();
            }
        }

        // 2. delete data from database
        // sql query to delete data from database
        $sql= "DELETE FROM category WHERE id= $id ";

        // execute the query
        $res= mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));

        // check whether the query is executed or not
        if($res==true){
            // set the success message
            $_SESSION['delete']= "<div class='success'>Category deleted successfully!</div>";
            // redirect to Manage category page 
            header('location:'.SITEURL.'admin/manage-category.php');
        } else{
            // set the failure message
            $_SESSION['delete']= "<div class='failure'>Failed to delete Category</div>";
            // redirect to Manage category page 
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        // redirect to Manage category page 
        
    } else{
        // redirect to Manage category page 
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>
    

