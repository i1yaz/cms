<?php 
if (isset($_GET['p_id'])) {
    $get_post_id = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id = $get_post_id ";
$result_select_posts_by_id = mysqli_query($connection,$query);
while ($row = mysqli_fetch_assoc($result_select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_cat_id = $row['post_cat_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_comment_count = $row['post_comment_count'];                                                        
    $post_date = $row['post_date'];

}
if (isset($_POST['update_post'])) {

    $post_author = $_POST['post_author'];
    $post_title =  $_POST['post_title'];
    $post_cat_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image =  $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_tags    =    $_POST['post_tags'];
    $post_content =    $_POST['post_content'];

    $post_author = mysqli_real_escape_string($connection,$post_author);
    $post_title =  mysqli_real_escape_string($connection,$post_title);
    $post_cat_id = mysqli_real_escape_string($connection,$post_cat_id);
    $post_status = mysqli_real_escape_string($connection,$post_status);
    $post_tags = mysqli_real_escape_string($connection,$post_tags);
    $post_content = mysqli_real_escape_string($connection,$post_content);
    

    move_uploaded_file($post_image_temp,"../images/$post_image");
    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $get_post_id ";
        $result_image = mysqli_query($connection,$query);
        while ($row = mysqli_fetch_array($result_image)) {
            $post_image = $row['post_image'];
    }

    $query = "UPDATE posts SET post_cat_id='{$post_cat_id}', post_title='{$post_title}', post_author='{$post_author}', post_date= now() , post_image='{$post_image}', post_content='{$post_content}', post_tags='{$post_tags}', post_status='{$post_status}' WHERE post_id = {$get_post_id}";

    $result_update = mysqli_query($connection,$query);
    confirmQuery($result_update);

}
    

$query = "UPDATE posts SET post_cat_id='{$post_cat_id}', post_title='{$post_title}', post_author='{$post_author}', post_date= now() , post_image='{$post_image}', post_content='{$post_content}', post_tags='{$post_tags}', post_status='{$post_status}' WHERE post_id = {$get_post_id}";

$result_update = mysqli_query($connection,$query);
confirmQuery($result_update);

}

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Edit Title</label>
        <input value="<?php echo $post_title ?> " type="text" class="form-control" name="post_title">
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
        <label for="post_author">Edit Author</label>
        <input value="<?php echo $post_author ?> " type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="post_status">Edit Status</label>
        <input value="<?php echo $post_status ?> " type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <img width='100' src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Edit Tags</label>
        <input value="<?php echo $post_tags ?> " type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Edit Content</label>
        <textarea  class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content ?> </textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" Value="Update Post">
    </div>
</form>