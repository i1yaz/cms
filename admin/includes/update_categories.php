<!-- Edit Category Form -->

<form action="" method="post">

    <div class="form-group">
        <label for="cat_title">Edit Category</label>

        <?php 
if (isset($_GET['edit'])) {

    $cat_edit_id= $_GET['edit'];
    
    $query = "SELECT * FROM categories WHERE cat_id=$cat_edit_id";
    $result_select_catg_id = mysqli_query($connection,$query);
    
    while ( $row = mysqli_fetch_assoc($result_select_catg_id) ) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    ?>
        <input value="<?php if(isset($cat_title)) {echo $cat_title;} ?>" type="text" class="form-control"
            name="cat_title">

        <?php }
}                       
?>

        <?php 
//  Update Categories
if ( isset($_POST['update_category'])) {
$the_cat_title = $_POST['cat_title'];
$update_query = "UPDATE categories SET cat_title = '{$the_cat_title}'  WHERE cat_id = {$cat_id}";
$update_query = mysqli_query($connection,$update_query);

if (!$update_query) {
    die ("QUERY FAILED " . mysqli_error($connection) );
}

header("Location: categories.php");
} 

?>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
    </div>

</form>