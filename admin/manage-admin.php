<?php include('partials/menu.php')   ;?>  
         
         <!---Main content section starts--->
         <div class="main-content">
         <div class="wrapper">
                <h1> Manage Admin</h1>
                <br/>
                <?php
                   if(isset($_SESSION['add'])){
                       echo $_SESSION['add']; //displaying session message
                       unset($_SESSION['add']);  //removing session message

                   }
                   if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete']; //displaying session message
                    unset($_SESSION['delete']);  //removing session message

                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update']; //displaying session message
                    unset($_SESSION['update']);  //removing session message

                }
                if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd']; //displaying session message
                    unset($_SESSION['change-pwd']);  //removing session message

                }
                if(isset($_SESSION['pwd-not-match'])){
                    echo $_SESSION['pwd-not-match']; //displaying session message
                    unset($_SESSION['pwd-not-match']);  //removing session message

                }
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found']; //displaying session message
                    unset($_SESSION['user-not-found']);  //removing session message

                }

                ?>
                </br></br>
                <a href="add-admin.php" class="btn-primary"> Add Admin</a>
                <br/><br/><br/>


                <table class="tbl">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th> Actions</th>


                    </tr>
                    <?php
                       //query to get all admin
                       $sql="SELECT * FROM tbl_admin";
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
                                $id=$rows['id'];
                                $full_name=$rows['fullname'];
                                $username=$rows['username'];
                                
                                //display the values in our table
                                ?>
                                <tr>
                                   <td><?php echo $sn++ ;?></td>
                                   <td><?php echo $full_name; ?></td>
                                   <td><?php echo $username; ?></td>
                                   <td>
                                    <a href="<?php echo SITEURL;?>/admin/update-password.php?id=<?php echo $id;?>" class="btn-primary"> Change Password </a>
                                    <a href="<?php echo SITEURL;?>/admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary"> Update Admin</a>
                                    <a href="<?php echo SITEURL;?>/admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">delete Admin</a>
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
         <!---Main content section ends--->

         <?php include('partials/footer.php')   ;?> 

    </body>
</html>
