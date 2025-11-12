<?php include "includes/dbname.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-header">Results:</h1>

            <?php
            if (isset($_POST['submit'])) {
                $search = $_POST['search'];

                // استعلام البحث
                $query = "SELECT * FROM posts WHERE post_title LIKE '%$search%' OR post_content LIKE '%$search%'";
                $search_query = mysqli_query($conn, $query);

                $count = mysqli_num_rows($search_query);
                if ($count == 0) {
                    echo "<h2>NO RESULT!</h2>";
                } else {
                    while ($row = mysqli_fetch_assoc($search_query)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
            ?>
                        <!-- عرض نتيجة واحدة -->
                        <h2><a href="#"><?php echo $post_title; ?></a></h2>
                        <p class="lead"> by <a href="#"><?php echo $post_author; ?></a></p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo substr($post_content, 0, 150) . '...'; ?></p>
                        <a class="btn btn-primary" href="#">Read more<span class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>
                        <a class="btn btn-primary" href="index.php">Home Page<span class="fa fa_home"></span></a>

            <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
