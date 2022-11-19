<?php include('partials/menu.php')   ;?> 
 
<div class="main-content">
       <div class="wrapper">
                  <?php
                   //1.get the id of selected id
                   $id=$_GET['id'];
                   ?>
                <h2> Update Password</h2>
                <br/><br/>
                <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current password: </td>
                        <td>
                            <input type="password" name="current_password" placeholder ="Current Password">
                        </td>
                    </tr>
                    <tr>
                        <td>New password: </td>
                        <td>
                            <input type="password" name="new_password" placeholder ="New Password">
                        </td>
                    </tr>
                    <tr>
                        <td> Confirm Password </td>
                        <td>
                            <input type="password" name="confirm_password" placeholder ="confirm Password">
                        </td> 
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary"/> 
                        </td>
                       
                    </tr>

                </form>
    <?php
        if(isset($_POST["submit"])){
            // 1. get data from form
            $id= $_POST['id'];
            $current_password= md5($_POST['current_password']);
            $new_password= md5($_POST['new_password']);
            $confirm_password= md5($_POST['confirm_password']);

            // 2. SQL query to check whether the user is present or not (authentication)
            $sql= "SELECT * FROM tbl_admin WHERE id= $id AND password= '$current_password' ";
            
            // 3. execute query 
            $res= mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));

            if($res==true){
                // check whether the data is available or not
                $count= mysqli_num_rows($res);

                if($count==1){
                    //if user exist the password change
                    if($new_password==$confirm_password){
                        // update the password
                        $sql2= "UPDATE tbl_admin SET password='$new_password' WHERE id=$id ";

                        // execute the query
                        $res= mysqli_query($conn, $sql2) or die('error'.mysqli_error($conn));

                        // check whether the query is executed or not
                        if($res==true){
                            // Create a session variable to Display Message 
                            $_SESSION['change-pwd']= "<div class='success'>Password Updated</div>";
                            //Redirect Page to Manage Admin  
                            header("location:".SITEURL.'admin/manage-admin.php');
                        } else{
                            // Create a session variable to Display Message 
                            $_SESSION['change-pwd']= "<div class='success'>Password Not Updated</div>";
                            //Redirect Page to Manage Admin  
                            header("location:".SITEURL.'admin/update-admin.php');
                        }


                    } else{
                    //user not exist and set message and redirect
                    $_SESSION['pwd-not-match']= "<div class= 'error'>Password not Match</div>";
                    // redirect the user
                    header("location:".SITEURL."admin/manage-admin.php");
                    }

                }else{
                    //user not exist and set message and redirect
                    $_SESSION['user-not-found']= "<div class= 'error'>User not found</div>";
                    // redirect the user
                    header("location:".SITEURL."admin/manage-admin.php");
                }
            }
        }
    
    ?>
                
                

        </div>
</div>

