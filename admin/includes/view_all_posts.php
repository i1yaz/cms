
<?php 
if (isset($_POST['checkBoxArray'])) {
    foreach ( $_POST['checkBoxArray'] as $checkBoxValue) {
        $bulk_option = $_POST['bulk_options'];
        switch ($bulk_option) {
            case 'published':
                $query = "UPDATE posts SET post_status ='{$bulk_option}' WHERE post_id = '{$checkBoxValue}' ";
                $result_update_publish = mysqli_query($connection,$query);
                if (!$result_update_publish) {
                    die("QUERY FAILED ". mysqli_error($connection));
                }
                break;
                case 'draft':
                $query = "UPDATE posts SET post_status ='{$bulk_option}' WHERE post_id = '{$checkBoxValue}' ";
                $result_update_draft = mysqli_query($connection,$query);
                if (!$result_update_draft) {
                    die("QUERY FAILED ". mysqli_error($connection));
                }
                break;
                case 'delete':
                
                $query = "DELETE FROM posts WHERE post_id = '{$checkBoxValue}' ";
                $result_delete = mysqli_query($connection,$query);
                if (!$result_delete) {
                    die("QUERY FAILED ". mysqli_error($connection));
                }
                break;
                case 'clone':
                
                $query = "SELECT * FROM posts WHERE post_id='{$checkBoxValue}' ";
                $result_clone = mysqli_query($connection,$query);
                if (!$result_clone) {
                    die("QUERY FAILED ". mysqli_error($connection));
                }
                while ($row = mysqli_fetch_array($result_clone)) {
                    $post_title = $row['post_title'];
                    $post_cat_id = $row['post_cat_id'];
                    $post_date = $row['post_date'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }
                $query_clone_insert = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES ($post_cat_id ,'{$post_title}','{$post_author}',$post_date,'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
                $result_clone_insert = mysqli_query($connection,$query_clone_insert);
                if (!$result_clone_insert) {
                    die("QUERY FAILED ". mysqli_error($connection));
                }
                break;
            default:
                
                break;
        }
        
    }
}
?>

<form action="" method="post">
<table class="table table-bordered table-hover">
<div id="bulkOptionsContainer" class="col-xs-4">
<select class="form-control" name="bulk_options" id="">
<option value="">Select Option</option>
<option value="published">Publish</option>
<option value="draft">Draft</option>
<option value="delete">Delete</option>
<option value="clone">Clone</option>
</select>
</div>
<div class="col-xs-4">
<input type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
</div>

    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Views</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        
    </thead>
    <tbody>
        <?php 
                        $query = "SELECT * FROM posts ORDER BY post_id DESC";
                        $result_select_posts = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($result_select_posts)) {
                            $post_id = $row['post_id'];
                            $post_author = $row['post_author'];
                            $post_title = $row['post_title'];
                            $post_cat_id = $row['post_cat_id'];
                            $post_status = $row['post_status'];
                            $post_image = $row['post_image'];
                            $post_tags = $row['post_tags'];
                            $post_comment_count = $row['post_comment_count'];                                                        
                            $post_date = $row['post_date'];
                            $post_views_count = $row['post_views_count'];
                            
                            //$post_content = $row['post_content'];
                            echo "<tr>";
                            ?>
                            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>
                            <?php
                            echo "<td>{$post_id}</td>";
                            echo "<td>{$post_author}</td>";
                            echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";

                            $query = "SELECT * FROM categories WHERE cat_id=$post_cat_id";
                            $result_post_catg_id = mysqli_query($connection,$query);
    
                            while ( $row = mysqli_fetch_assoc($result_post_catg_id) ) {
                            
                            $cat_title = $row['cat_title'];
                            
                            echo "<td>{$cat_title}</td>";
                            }

                            echo "<td>{$post_status}</td>";
                            echo "<td> <img src= '../images/{$post_image}' width='100' alt='image'></td>";
                            echo "<td>{$post_tags}</td>";
                            echo "<td>{$post_comment_count}</td>";
                            echo "<td><a href='posts.php?reset={$post_id}'> {$post_views_count}</a></td>";
                            echo "<td>{$post_date}</td>";
                            echo "<td><a class='glyphicon glyphicon-edit'  href='posts.php?source=edit_post&p_id={$post_id}'></a> </td>";
                            echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?') \" class='glyphicon glyphicon-trash' href='posts.php?delete={$post_id}'></a> </td>";
                            echo "</tr>";
                        }
                        ?>
                        <?php 
                        if (isset($_GET['delete'])) {
                            $the_post_id = $_GET['delete'];
                            $delete_query = "DELETE FROM posts WHERE post_id={$the_post_id}";
                            $result_delete = mysqli_query($connection,$delete_query);
                            confirmQuery($result_delete);
                            header("Location: posts.php");
                        }
                        if (isset($_GET['reset'])) {
                            $the_post_id = $_GET['reset'];
                            $reset_query = "UPDATE posts SET post_views_count = 0 WHERE post_id=". mysqli_real_escape_string($connection,$_GET['reset']) ." ";
                            $result_reset = mysqli_query($connection,$reset_query);
                            confirmQuery($result_reset);
                            header("Location: posts.php");
                        }
                        ?>

    </tbody>
</table>
</form>