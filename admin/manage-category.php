<?php include('partials/menu.php')   ;?>  
<div class="main-content">
       <div class="wrapper">
                <h1> Manage Category</h1>
                <br/>
                <a href="add-category.php" class="btn-primary"> Add Category</a>
                <br/><br/><br/>
                <?php
                   if(isset($_SESSION['add'])){
                       echo $_SESSION['add']; //displaying session message
                       unset($_SESSION['add']);  //removing session message

                   }
                   if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete']; //displaying session message
                    unset($_SESSION['delete']);  //removing session message

                }
                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove']; //displaying session message
                    unset($_SESSION['remove']);  //removing session message

                }
                if(isset($_SESSION['category_not_found'])){
                    echo $_SESSION['category_not_found']; //displaying session message
                    unset($_SESSION['category_not_found']);  //removing session message

                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update']; //displaying session message
                    unset($_SESSION['update']);  //removing session message
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload']; //displaying session message
                    unset($_SESSION['upload']);  //removing session message

                }
                if(isset($_SESSION['failed-remove'])){
                    echo $_SESSION['failed-remove']; //displaying session message
                    unset($_SESSION['failed-remove']);  //removing session message

                }

                ?>
                
                <table class="tbl">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th> Featured</th>
                        <th>Active</th>
                        <th>Actions</th>


                    </tr>
                    <?php
                       //query to get all admin
                       $sql="SELECT * FROM category";
                       // execute the query
                       $res=mysqli_query($conn,$sql);
                       if($res==True)
                       {
                        //count rows to check whether we have data in database or not
                           $count = mysqli_num_rows($res); // function to get all the rows in database
                           //check the num of rows
                           if($count>0)
                           {
                            // we have data in database
                              $sn=1;//create a variable to assign the value
                              while($rows=mysqli_fetch_assoc($res))
                              {
                                //using while loop to get all the data from database
                                //will run as long as we have data in database
                                
                                //get individual data
                                $id= $rows['id'];
                                $title= $rows['title'];
                                $image_name=$rows['image_name'];
                                $featured= $rows['featured'];
                                $active= $rows['active'];
                                
                                //display the values in our table
                                ?>
                                <tr>
                                   <td><?php echo $sn++ ;?></td>
                                   <td><?php echo $title; ?></td>
                                   <td>
                                        
                                        <?php
                                        
                                            if($image_name!=""){
                                                //Display the image
                                                ?> <!-- PHP breaks-->

                                                <img src="<?php echo SITEURL?>images/category/<?php echo $image_name?>" alt="" width="100px">

                                                <?php
                                            } else{
                                                //Display the message
                                                echo "<div class='failure'>Image Not Added</div>";
                                            }
                                        
                                        ?>
                                
                                    </td>
                                   <td><?php echo $featured; ?></td>
                                   <td><?php echo $active; ?></td>
                                   <td>
                                    
                                    <a href="<?php echo SITEURL;?>/admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary"> Update Category</a>
                                    <a href="<?php echo SITEURL;?>/admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">delete Category</a>
                                  </td>

                               </tr>
                               <?php
                                


                              }

                           }
                           else{
                            // we dont have data in database
                           }


                       }

                     ?>
                    
                </table>
               

        </div>
               
</div>

<?php include('partials/footer.php')   ;?> 