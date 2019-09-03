<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection,$username);
    $email = mysqli_real_escape_string($connection,$email);
    $password = mysqli_real_escape_string($connection,$password);

    $randSalt = "SELECT randSalt FROM users";
    $select_randSalt_query = mysqli_query($connection,$randSalt);
    if (!$select_randSalt_query) {
        die("QUERY FAILED " . mysqli_error($connection).' '.mysqli_errno($connection));
    }
    $row = mysqli_fetch_array($select_randSalt_query);
    $salt = $row['randSalt'];
    $password = crypt($password,$salt);

        $query = "INSERT INTO users(user_name, user_password, user_email,user_role) VALUES ('{$username}','{$password}','{$email}','subscriber')";
        $insert_query_result = mysqli_query($connection,$query);
        if (!$insert_query_result) {
            die("QUERY FAILED " . mysqli_error($connection).' '.mysqli_errno($connection));
        }
        $message = "Resgistration has been submitted";
    
}
?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                    <!-- <h6 class="text-center"><?php echo $message ?></h6> -->
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register" >
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
