<?php include('partials/constants.php')   ;?>  
<?php
// 1.get the id of the admin to be deleted
$id=$_GET['id'];

//2.create sql query to delete admin
$sql="DELETE FROM tbl_admin WHERE id=$id";
// 3.display message of successful execution
$res=mysqli_query($conn,$sql);
if($res==true){
 //query executed deleted successfully
$_SESSION['delete']= "<div class='success'>Admin deleted successfully.</div>";
header('location:'.SITEURL.'admin/manage-admin.php');


}
else{
    $_SESSION['delete']= "<div class='error'>Failed to delete Admin.Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
?>