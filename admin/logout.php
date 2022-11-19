<?php include('partials/constants.php'); ?>

<?php 
    // include constant for siteurl
  
    // session destroy
    session_destroy(); // unsets $_SESSION['user']

    // redirect to login page
    header('location:'.SITEURL.'admin/login.php');

?>