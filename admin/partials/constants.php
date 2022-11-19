<?php
// start session
session_start();

    //execute the sql query and save the data in db
    //create database connection if not possible stop and display error
    //localhost-host of db,username of db user,password of that username
    define('SITEURL',"http://localhost/food-delivery/");
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-delivery');
    $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
    $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());
    ?>
