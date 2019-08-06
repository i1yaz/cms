<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Login -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Enter Username" class="form-control">
                    </div>
                        <div class="input-group">
                        <input type="password" name="password" placeholder="Enter Password" class="form-control">
                        <span class="input-group-btn">
                        <button class="btn btn-primary" name="login" type="submit">Login</button>
                        </span>
                        </div>
                        
                    
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                <?php 
                $query = "SELECT * FROM categories";
                $result = mysqli_query($connection,$query);
                
                ?>

                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            <?php 
                            while ( $row = mysqli_fetch_assoc($result) ) {
                                $the_cat_id = $row['cat_id'];
                                $the_cat_title = $row['cat_title'];
                                echo "<li><a href='category.php?category=$the_cat_id '>{$the_cat_title}</a></li>";
                            }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <div>
                <!-- Side Widget Well -->
                <?php include "widget.php" ?>

            </div>
</div>
            
            