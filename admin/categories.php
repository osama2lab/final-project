<?php include "admin/../admin_includes/admin_header.php"?>

<!-- Navigation -->
<?php include "admin/../admin_includes/admin_navigation.php" ?>
   <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welecome To Admin Section
                            <small>Aurther</small>
                        </h1>
                        
                        <?php
                        if(isset($_POST['submit'])){
                            $cat_title = $_POST['cat_title'];
                            if(empty($cat_title)){
                                echo "this filed should not be empty";
                            }else{
                                $query="INSERT INTO categories(cat_title) ";
                                $query .="VALUE('$cat_title') ";
                                
                                $creat_category_query= mysqli_query($conn,$query);

                                if (!$creat_category_query){
                                    die('QUERY FAILED'. mysqli_error($conn));
                                }
                            }
                        }
                        ?>

                         <?php
                        // Find all categories
                        $query = "SELECT * FROM categories";
                        $select_categories = mysqli_query($conn, $query);
                        ?>

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                    <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                
                                        while ($row = mysqli_fetch_assoc($select_categories)) {                                                                            
                                            $cat_id = $row['cat_id'];                                                                                
                                            $cat_title = $row['cat_title'];                                                                                
                                            echo "<tr>";                                                                                
                                            echo "<td>{$cat_id}</td>";                                                                                
                                            echo "<td>{$cat_title}</td>";  
                                            echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";  
                                            echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td>";                                                                              
                                            echo "</tr>";
                                        }
                                    ?>
                                </td>
                                </tbody>
                            </table>
                    </div>
                    <?php
                        // DELETE QUERY
                        if (isset($_GET['delete'])) {
                            $the_cat_id = $_GET['delete'];
                            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                            $delete_query = mysqli_query($conn, $query);
                            header("Location: categories.php"); // Refreshes the page
                        }
                    ?>

                        
                        <div class="col-xs-6"> 
                            <!-- Add categoties form-->
                                <form action="" method="post"> 
                                    <div class="form-group"> 
                                        <label for="cat-title">Add Category</label> 
                                        <input type="text" class="form-control" name="cat_title"> 
                                    </div>
                                    <div class="form-group"> 
                                        <input type="submit" class="btn btn-primary" name="submit" value="Add Category"> 
                                    </div>
                                </form>

                                <!-- Edit categoties form-->
                                <form action="" method="post"> 
                                    <div class="form-group"> 
                                        <label for="cat-title">Edit Category</label> 
                                        <?php
                                        if (isset($_GET['edit'])) {
                                            $cat_id = $_GET['edit'];
                                            $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
                                            $select_categories_id = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                                                $cat_id = $row['cat_id'];
                                                $cat_title = $row['cat_title'];
                                                
                                        ?>

                                        <input type="text" class="form-control" name="cat_title" value="<?php echo $cat_title; ?>" >

                                        <?php
                                            }
                                        }
                                      
                                        ?>

                                        <?php
                                            // UPDATE QUERY
                                            if (isset($_POST['update_category'])) {
                                                $the_cat_title = $_POST['cat_title']; // $cat_id is available from the GET request logic above
                                                $query = "UPDATE categories SET cat_title = '{$the_cat_title}'WHERE cat_id = {$cat_id}";
                                                $update_query = mysqli_query($conn, $query);
                                                 header("Location: categories.php"); // Refreshes the page

                                                if (!$update_query) {
                                                    die("QUERY FAILED" . mysqli_error($connection));
                                                }
                                            }
                                        ?>


                                    </div>
                                    <div class="form-group"> 
                                        <input type="submit" class="btn btn-primary" name="update_category" value="Update category"> 
                                    </div>
                                </form>
                        </div>
                        <!-- /.row -->
        
                    </div>
                      </div>
                </div>


       <!--page content(header)-->
       <?php include "includes/../admin_includes/admin_footer.php" ?>