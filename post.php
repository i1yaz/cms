<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<!-- Navigation -->

<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php 

            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];
            }
                $query = "SELECT * FROM posts WHERE post_id=$the_post_id";
                $result = mysqli_query($connection,$query);
                while ( $row = mysqli_fetch_assoc($result) ) {

                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    
                    ?>

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
            <hr>
            <p><?php echo $post_content ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

            <?php  } ?>


            <!-- Blog Comments -->
            <?php 
                        if (isset($_POST['create_comment'])) {
                            $the_post_id = $_GET['p_id'];
                            $comment_author = $_POST['comment_author'];
                            $comment_email = $_POST['comment_email'];
                            $comment_content = $_POST['comment'];

                            $query = "INSERT INTO comments( com_post_id, com_author, com_email, com_content, com_status, com_date)";
                            $query .= "VALUES($the_post_id,'{$comment_author}', '{$comment_email}' ,'{$comment_content}','unapproved',now())";
                            $result_insert = mysqli_query($connection,$query);
                            if (!$result_insert) {
                                die("QUERY FAILED " . mysqli_error($connection));
                            }

                            $query_com_count= "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
                            $result_update = mysqli_query($connection,$query_com_count);
                            if (!$result_update) {
                                die("QUERY FAILED ". mysqli_error($connection));
                            }
                        }
                        ?>
            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="comment_author">Name</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" rows="3" name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php 
                        
                         $query = "SELECT * FROM comments WHERE com_post_id={$the_post_id} AND com_status = 'approved' ORDER BY com_id DESC ";
                         $select_com_query = mysqli_query($connection,$query);
                         if (!$select_com_query) {
                            die("QUERY FAILED " . $connection);                         
                        }
                        while ($rows = mysqli_fetch_array($select_com_query) ) {
                            $com_date = $rows['com_date'];
                            $com_content = $rows['com_content'];
                            $com_author = $rows['com_author'];
                            ?>
                            <!-- Comment -->

                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $com_author; ?>
                                        <small><?php echo $com_date ?></small>
                                    </h4>
                                    <?php echo $com_content ?>
                                </div>
                            </div>
                        <?php } ?>


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>
    <!-- Footer -->
    <?php include "includes/footer.php" ?>