<?php include('partials/menu.php')   ;?>
<div class="main-content">
         <div class="wrapper">
                <h1> Add Admin </h1>
<br><br> 
                <?php
                   if(isset($_SESSION['add'])){
                       echo $_SESSION['add']; //displaying session message
                       unset($_SESSION['add']);  //removing session message

                   }
                ?>
                <form action="" method="POST">
                    <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td><input type="text" name="fullname" placeholder="Enter your Name"></td>
                    </tr>
                    <tr>
                        <td>username: </td>
                        <td><input type="text" name="username" placeholder="Enter your username"></td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="Password" placeholder="Enter your Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary"/> </td>
                       
                    </tr>
                    
                        
                    </table>
                </form>

</div>
</div>
<?php include('partials/footer.php')   ;?> 
<?php
//process the value from form and add it in database
//check whether the submit button is clicked or not
if(isset($_POST['submit'])){
    //button clicked
    //get data from form
     $full_name=$_POST['fullname'];
     $username=$_POST['username'];
     $Password=md5($_POST['Password']);//encrypt the password with md5
    //sql query to save the data to database
    $sql="INSERT INTO tbl_admin SET
    fullname='$full_name',
    username='$username',
    password='$Password'";
    
    
    
//exeuting query and saving data into data base
    $res=mysqli_query($conn,$sql) or die(mysqli_error());
    if($res==TRUE){
        //create a session variable to display message
        $_SESSION['add']="<div class='success'>Admin Added successfully</div>";
        //redirect page
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['add']="<div class='error'>Failed to add admin</div>";
        //redirect page add admin
        header("location:".SITEURL.'admin/manage-admin/add-admin.php');

    }
    
}
 ?>