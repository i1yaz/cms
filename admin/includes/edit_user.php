<?php 

if (isset($_GET['edit_user'])) {
    $the_user_id = $_GET['edit_user'];
    $the_user_id = $the_user_id;

    $query = "SELECT * FROM users WHERE user_id= $the_user_id";
    $result_select_users = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($result_select_users)) {
        $the_user_id = $row['user_id'];
        $the_user_name = $row['user_name'];
        $the_user_password = $row['user_password'];
        $the_user_firstname = $row['user_firstname'];
        $the_user_lastname = $row['user_lastname'];
        $the_user_email = $row['user_email'];
        $the_user_image = $row['user_image'];
        $the_user_role = $row['user_role'];
    }


if (isset($_POST['edit_user'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_name = $_POST['user_name'];

    // $post_image = $_FILES['post_image']['name'];
    // $post_image_temp = $_FILES['post_image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $post_date = date('d-m-y');
    // $post_comment_count = 0;

    $user_firstname = mysqli_real_escape_string($connection,$user_firstname);
    $user_lastname = mysqli_real_escape_string($connection,$user_lastname);
    $user_role = mysqli_real_escape_string($connection,$user_role);
    $user_name = mysqli_real_escape_string($connection,$user_name);
    $user_email = mysqli_real_escape_string($connection,$user_email);
    $user_password = mysqli_real_escape_string($connection,$user_password);

    
    
    $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
    $get_user = mysqli_query($connection,$query_password);
    if (!$get_user) {
        die("QUERY FAILED ". $connection);
    }
    $row = mysqli_fetch_array($get_user);
    $db_user_password = $row['user_password'];
    if ($db_user_password != $user_password) {
        $hash_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>10));
    }

    $update_query = "UPDATE users SET user_name='{$user_name}',user_password='{$hash_password}',";
    $update_query .= "user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',user_email='{$user_email}',user_role='{$user_role}' WHERE user_id=$the_user_id";
    
    $result_update = mysqli_query($connection,$update_query);

    if (!$result_update) {
        die("QUERY FAULED ". mysqli_error($connection));
    }
    echo "User Updated " . "<a href='users.php'>View Users</a>";
    header ("Location: users.php");
}
}else {
    header ("Location: index.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" value="<?php echo $the_user_firstname; ?>" class="form-control" name="user_firstname" required  > 
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" value="<?php echo $the_user_lastname; ?>" class="form-control" name="user_lastname" required >
    </div>

    <div class="form-group">
        <select class="" name="user_role" id="">
        <option value="<?php echo $the_user_role; ?>"><?php echo $the_user_role; ?></option>
        <?php 
        if ($the_user_role == 'admin') {
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
        <label for="user_name">Username</label>
        <input type="text" value="<?php echo $the_user_name; ?>" class="form-control" name="user_name" required>
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" value="<?php echo $the_user_email ?>" class="form-control" name="user_email" required>
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" value="<?php echo $the_user_password ?>" class="form-control" name="user_password" required>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" Value="Update">
    </div>

</form>