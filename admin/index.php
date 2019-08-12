<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>                      
                    </div>
                </div>
                <!-- /.row -->

                   
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                    $select_posts = "SELECT * FROM posts";
                    $result_query = mysqli_query($connection,$select_posts);
                    $post_count = mysqli_num_rows($result_query);
                    
                    ?>
                  <div class='huge'><?php echo $post_count; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <?php 
                    $select_comments = "SELECT * FROM comments";
                    $result_query = mysqli_query($connection,$select_comments);
                    $comments_count = mysqli_num_rows($result_query);
                    ?>
                    <div class="col-xs-9 text-right">
                     <div class='huge'><?php echo $comments_count ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                    $select_users = "SELECT * FROM users";
                    $result_query = mysqli_query($connection,$select_users);
                    $users_count = mysqli_num_rows($result_query);
                    ?>
                    <div class='huge'><?php echo $users_count; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                    $select_categories = "SELECT * FROM categories";
                    $result_query = mysqli_query($connection,$select_categories);
                    $categories_count = mysqli_num_rows($result_query);
                    ?>
                        <div class='huge'><?php echo $categories_count; ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->

                <?php 
                //Publihsed post count
                $select_published_posts = "SELECT * FROM posts WHERE post_status = 'published'";
                $result_post_query = mysqli_query($connection,$select_published_posts);
                $post_published_count = mysqli_num_rows($result_post_query);
                //Draft post count
                $select_draft_posts = "SELECT * FROM posts WHERE post_status = 'draft'";
                $result_post_query = mysqli_query($connection,$select_draft_posts);
                $post_draft_count = mysqli_num_rows($result_post_query);
                // Unapproved Comments Count
                $select_unapproved_comments = "SELECT * FROM comments WHERE com_status = 'unapproved'";
                $result_comments_query = mysqli_query($connection,$select_unapproved_comments);
                $post_unapproved_comments = mysqli_num_rows($result_comments_query);
                // User Role
                $select_users = "SELECT * FROM users WHERE user_role = 'subscriber'";
                $result_all_subscribers = mysqli_query($connection,$select_users);
                $subscriber_count = mysqli_num_rows($result_all_subscribers);
                ?>
                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Data', 'Count'],
            <?php
            $element_text = ['All Posts','Active Posts','Draft','Comments','Pending Comments','Users','Subscriber','Categories'];
            $element_count = [$post_count,$post_published_count,$post_draft_count,$comments_count,$post_unapproved_comments,$users_count,$subscriber_count,$categories_count];
            for ($i=0; $i < 7; $i++) { 
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
            }
            ?>
           
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>