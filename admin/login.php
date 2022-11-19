<?php include('partials/constants.php')   ;?> 
<html>
    <head>
        <title>Login-Food Order System </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login </h1><br><br>
            <?php
                 if(isset($_SESSION['login'])){  
                    echo $_SESSION['login'];
                    unset($_SESSION['login']); 
                } 
                if(isset($_SESSION['no-login-message'])){  
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']); 
                }
                ?>
                <br>
            <form action="" method="POST" class="text-center">
            UserName:
            <br>
            
            <input type="text" name="username" placeholder="Enter username"> <br>  <br>  

           <label for="password">Password:</label> <br>
          <input type="password" name="password" placeholder="Enter password"> <br><br>

           <input type="submit" name="submit" value="Login" class="btn-primary"> <br> <br>


            

       </div>
    </body>
</html>
<?php
    if(isset($_POST['submit']))
    {
        //1.get the data from form
        $username=$_POST['username'];
        $password=md5($_POST['password']);
         
        //2. SQL query to check whether the user with username and password exists or not

        $sql= "SELECT * from tbl_admin where username='$username' and password='$password'";
        
        $res=mysqli_query($conn,$sql);

        $count= mysqli_num_rows($res);

            if($count==1){
                // Success msg
                $_SESSION['login']= "<div class='success'>Login Successfull!</div>";
                $_SESSION['user']= $username; //to check whether the user is logged in or not and logout will unset it

                // Redirect to Manage admin page
                header('location:'.SITEURL.'admin/index.php');
            } 
            else{
                // Failure msg
                $_SESSION['login']= "<div class='error text-center'>User and Password didn't match</div>";
                // Redirect to Login page
                header('location:'.SITEURL.'admin/login.php');
            }




    }
 


