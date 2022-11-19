<?php include('partials/menu.php')   ;?>
<div class="main-content">
         <div class="wrapper">
                <h1> Add Category </h1>
                <?php
                   if(isset($_SESSION['add'])){
                       echo $_SESSION['add']; //displaying session message
                       unset($_SESSION['add']);  //removing session message

                   }
                   if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload']; //displaying session message
                    unset($_SESSION['upload']);  //removing session message

                }
                ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td><input type="text" name="title" placeholder="Category title"></td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                   </tr>
                    
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary"/> </td>
                       
                    </tr>
                    
                        
                    </table>
                </form>


</div>

</div>
<?php include('partials/footer.php')   ;?> 
<?php
if(isset($_POST['submit'])){
    //button clicked
    //get data from form
     $title=$_POST['title'];
     //for radio input we need to check if the button is selected or not
     if(isset($_POST['featured']))
    {
        $featured=$_POST['featured'];

    }
    else{
        $featured="No";
    }
    if(isset($_POST['Active']))
    {
        $active=$_POST['Active'];

    }
    else{
        $active="No";
    }
    //check whether the image is selected or not
    if(isset(($_FILES['image']['name'])))
    {//upload the image
        $image_name=$_FILES['image']['name'];
        //auto remane our image 
        //get the extension of image
        if($image_name!=""){
        $ext=end(explode('.',$image_name));
        
        // rename the image
        $image_name="Food_Category_".rand(000,999).'.'.$ext;
        $source_path=$_FILES['image']['tmp_name'];
        $destination_path="../images/category/".$image_name;
        $upload=move_uploaded_file($source_path,$destination_path);
        //check if the image is uploaded
        //if the image is not uploaded we will stop the process and redirect with errer
        if($upload==false){
            $_SESSION['upload']="<div class='error'>Failed to upload image. </div>";
            header("location:".SITEURL.'admin/manage-category/add-category.php');
            die();
        }
    }}
    else
    { //dont upload the image and set the value as blank
        $image_name="";
    }
    $sql="INSERT INTO category SET title='$title',
                                   image_name='$image_name',
                                   featured='$featured',
                                   active='$active'";
//exeuting query and saving data into data base
    $res=mysqli_query($conn,$sql) or die('error'.mysqli_error($conn));
    if($res==TRUE){
        //create a session variable to display message
        $_SESSION['add']="<div class='success'>Category Added successfully</div>";
        //redirect page
        header("location:".SITEURL.'admin/manage-category.php');
    }
    else{
        $_SESSION['add']="<div class='error'>Failed to add category</div>";
        //redirect page add category
        header("location:".SITEURL.'admin/manage-category/add-category.php');

    }
    
}?>












