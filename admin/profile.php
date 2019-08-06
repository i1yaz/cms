<?php include "includes/admin_header.php" ?>


<?php 
if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    $select_query = "SELECT * FROM users WHERE user_name = '{$username}'";
    $result_select_query = mysqli_query($connection,$select_query);
    if (!$result_select_query) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_array($result_select_query)) {
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
    }
}
?>
<?php 

if (isset($_POST['update_profile'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_name = $_POST['user_name'];

    // $post_image = $_FILES['post_image']['name'];
    // $post_image_temp = $_FILES['post_image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    // $post_date = date('d-m-y');
    // $post_comment_count = 0;

    $user_firstname = mysqli_real_escape_string($connection,$user_firstname);
    $user_lastname = mysqli_real_escape_string($connection,$user_lastname);
    $user_role = mysqli_real_escape_string($connection,$user_role);
    $user_name = mysqli_real_escape_string($connection,$user_name);
    $user_email = mysqli_real_escape_string($connection,$user_email);
    $user_password = mysqli_real_escape_string($connection,$user_password);


    //move_uploaded_file($post_image_temp,"../images/$post_image");

    $update_query = "UPDATE users SET user_name='$user_name',user_password='$user_password',";
    $update_query .= "user_firstname='$user_firstname',user_lastname='$user_lastname',user_email='$user_email',user_role='$user_role' WHERE user_name='{$user_name}'";
    
    $result_update = mysqli_query($connection,$update_query);

    if (!$result_update) {
        die("QUERY FAULED ". mysqli_error($connection));
    }
    header ("Location: users.php");
}
?>


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

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" value="<?php echo $user_name; ?>" class="form-control" name="user_name" readonly >
    </div>
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname" required  > 
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname" required >
    </div>

    <div class="form-group">
        <select class="" name="user_role" id="">
        <option value="admin"><?php echo $user_role; ?></option>
        <?php 
        if ($user_role == 'admin') {
            echo "<option value='subscriber'>subscriber</option>";
        }else {
            echo "<option value='admin'>admin</option>";
        }
        ?>

        </select>
        
    </div>
    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div> -->
    

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email" required>
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password" required>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_profile" Value="Update Profile">
    </div>

</form>
                  
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <?php include "includes/admin_footer.php" ?>