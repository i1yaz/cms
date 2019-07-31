<?php 
if (isset($_POST['submit_post'])) {

    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_cat_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    //$post_comment_count = 0;

    $post_title = mysqli_real_escape_string($connection,$post_title);
    $post_author = mysqli_real_escape_string($connection,$post_author);
    $post_cat_id = mysqli_real_escape_string($connection,$post_cat_id);
    $post_status = mysqli_real_escape_string($connection,$post_status);
    $post_tags = mysqli_real_escape_string($connection,$post_tags);
    $post_content = mysqli_real_escape_string($connection,$post_content);
    //$post_comment_count = mysqli_real_escape_string($connection,$post_comment_count);

    move_uploaded_file($post_image_temp,"../images/$post_image");

    $insert_query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status)";
    $insert_query .= "VALUES ({$post_cat_id},'{$post_title}','{$post_author}', now() ,'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
    
    $result_insert = mysqli_query($connection,$insert_query);

    confirmQuery($result_insert);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <select class="" name="post_category" id="">
        <?php 
        $query = "SELECT * FROM categories";
        $result_select_catg = mysqli_query($connection,$query);
        confirmQuery($result_select_catg);
        while ( $row = mysqli_fetch_assoc($result_select_catg) ) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<option value='$cat_id'>{$cat_title}</option>";
        }
        ?>
        </select>
        
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit_post" Value="Publish Post">
    </div>
</form>