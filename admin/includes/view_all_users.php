<table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Role</th>
                                <!-- <th>Date</th> -->
                                <th>Admin</th>
                                <th>Subscriber</th>
                                <th>Delete</th>
                                <th>Edit</th>

                            </tr>

                        </thead>
                        <tbody>
                            <?php 
                        $query = "SELECT * FROM users";
                        $result_users = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($result_users)) {
                            $user_id = $row['user_id'];
                            $user_name = $row['user_name'];
                            $user_password = $row['user_password'];
                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            $user_email = $row['user_email'];
                            $user_image = $row['user_image'];
                            $user_role = $row['user_role'];
                            
                            echo "<tr>";
                            echo "<td>{$user_id}</td>";
                            echo "<td>{$user_name}</td>";
                            echo "<td>{$user_firstname}</td>";
                            echo "<td>{$user_lastname}</td>";
                            echo "<td>{$user_email}</td>";
                            echo "<td>{$user_image}</td>";
                            echo "<td>{$user_role}</td>";
                            echo "<td><a class='glyphicon glyphicon-ok'  href='users.php?change_to_admin={$user_id}'>Admin</a> </td>";
                            echo "<td><a class='glyphicon glyphicon-remove' href='users.php?change_to_sub={$user_id}'>Subscriber</a> </td>";
                            echo "<td><a class='glyphicon glyphicon-edit' href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a> </td>";
                            echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?') \" class='glyphicon glyphicon-trash' href='users.php?delete={$user_id}'></a> </td>";
                            echo "</tr>";
                        }
                        ?>
                            <?php 

                        if (isset($_GET['change_to_admin'])) {
                            $the_user_id = $_GET['change_to_admin'];
                            $admin_query = "UPDATE users SET user_role='admin' WHERE user_id=$the_user_id";
                            $result_admin = mysqli_query($connection,$admin_query);
                            if (!$result_admin) {
                                die ("QUERY FAILED ". mysqli_error($connection));
                            }
                            header("Location: users.php");
                        }

                        if (isset($_GET['change_to_sub'])) {
                            $the_user_id = $_GET['change_to_sub'];
                            $sub_query = "UPDATE users SET user_role='subscriber' WHERE user_id=$the_user_id";
                            $result_sub = mysqli_query($connection,$sub_query);
                            if (!$result_sub) {
                                die ("QUERY FAILED ". mysqli_error($connection));
                            }
                            header("Location: users.php");
                        }


                        if (isset($_GET['delete'])) {
                            $the_user_id = $_GET['delete'];
                            $delete_query = "DELETE FROM users WHERE user_id={$the_user_id}";
                            $result_delete = mysqli_query($connection,$delete_query);
                            if (!$result_delete) {
                                die ("QUERY FAILED ". mysqli_error($connection));
                            }
                            header("Location: users.php");
                        }
                        ?>

                        </tbody>
                    </table>