<?php 
if (isset($_POST['create_user'])) {

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
    $user_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>10));

    $signup_query = "INSERT INTO users( user_name, user_password, user_firstname, user_lastname, user_email, user_role) ";
    $signup_query .= "VALUES ('{$user_name}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}') ";
    
    $result_signup = mysqli_query($connection,$signup_query);

    if (!$result_signup) {
        die("QUERY FAULED ". mysqli_error($connection));
    }
    echo "User Created: ". " ". "<a href='users.php'>View Users</a>";
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" required  > 
    </div>
    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" required >
    </div>
    <div class="form-group">
        <select class="" name="user_role" id="">
        <option value="admin">Select Option</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
        </select>
        
    </div>
    <!-- <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div> -->
    <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name" required>
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" required>
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" required>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" Value="Sign Up">
    </div>

</form>