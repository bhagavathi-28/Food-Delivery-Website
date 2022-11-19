<?php include('partials/menu.php')   ;?> 
 
<div class="main-content">
       <div class="wrapper">
                <h2> Update Admin</h2>
                <br/><br/>
                <?php
                   //1.get the id of selected id
                   $id=$_GET['id'];
                   //2.create sql query to get the  details
                   $sql="SELECT * FROM tbl_admin WHERE id=$id";

                   //execute the query
                   $res=mysqli_query($conn,$sql) or die("error in query".mysqli_error($conn));
                   //
                   if($res==True){

                    $count = mysqli_num_rows($res);
                    if($count==1){
                        echo "Admin avaliable";

                        $rows=mysqli_fetch_assoc($res);
                        $fullname=$rows['fullname'];
                        $username=$rows['username'];


                    }
                    else{
                        header('location:'.SITEURL.'admin/manage-admin.php');

                    }

                   }



                ?>
                <form action="" method="POST">
                    <table class="tbl-30">
                    <tr>
                        <td>Full Name: </td>
                        <td>
                            <input type="text" name="fullname" value ="<?php echo $fullname ;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>username: </td>
                        <td>
                            <input type="text" name="username" value ="<?php echo $username ;?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary"/> 
                        </td>
                       
                    </tr>
                    
                        
                    </table>
                </form>

                

        </div>
</div>
<?php
if(isset($_POST['submit'])){
     //1.get data from form 
     $id=$_POST['id'];
     $fullname=$_POST['fullname'];
     $username=$_POST['username'];

     //2. sql query
    $sql= "UPDATE tbl_admin SET
           fullname='$fullname',
           username='$username'
           WHERE id='$id'
            ";
    //3 .
    $res=mysqli_query($conn,$sql) or  die("error in query".mysqli_error($conn));
    if($res== true){
        $_SESSION['update']="<div class='success'> Admin updated succesfully</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['update']="<div class='error'> Admin not updated</div>";
        header("location:".SITEURL.'admin/update-admin.php');

    }
}
?>
<?php include('partials/footer.php')   ;?>  
