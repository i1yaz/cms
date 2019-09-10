<?php


function users_online(){

    if (isset($_GET['onlineusers'])) {
       
        global $connection;
    
     if (!$connection) {
        
        session_start();
        include "../includes/db.php"; 
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;
        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection,$query);
        $row_count = mysqli_num_rows($send_query);
        if ($row_count == NULL) {
            mysqli_query($connection,"INSERT INTO users_online(session,time) VALUES('$session','$time')");
        }
        else {
            mysqli_query($connection,"UPDATE users_online SET time = $time WHERE session = $session");
        }
        $users_online_query = mysqli_query($connection,"SELECT * FROM users_online WHERE time > $time_out");
        $count_user = mysqli_num_rows($users_online_query);
        echo $count_user;
        

         }
   
    }//get request isset
}
users_online();

function confirmQuery($result)
{
    global $connection;
    if (!$result) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
}

function insert_categories(){
    global $connection;
    
    if ( isset($_POST['submit'])) {
                            
        $cat_name = $_POST['cat_title'];

        $cat_name = mysqli_real_escape_string($connection,$cat_name);

        if ($cat_name == "" || empty($cat_name)) {
            echo "<font color='red'> Category name should not be empty</font>";
        }else {
            
            $query = "INSERT INTO categories(cat_title) VALUES ('{$cat_name}')";
            $create_category_query = mysqli_query($connection,$query);

            if (!$create_category_query) {
                die("Query Failer " . mysqli_error($connection));
            }
        }
    }
}

function findAllCategories(){
    global $connection;

    $query = "SELECT * FROM categories";
    $result_select_catg = mysqli_query($connection,$query);
    while ( $row = mysqli_fetch_assoc($result_select_catg) ) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo
    "<td>
    <a class='glyphicon glyphicon-trash' href='categories.php?delete={$cat_id}'></a>
    </td>";
    echo "
    <td>
    <a class='glyphicon glyphicon-edit' href='categories.php?edit={$cat_id}'></a>
    </td>";
    echo "</tr>";
    }
}

function deleteQuery(){
    //DELETE QUERY
    global $connection;
    if ( isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $delete_query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $result_delete = mysqli_query($connection,$delete_query);
        header("Location: categories.php");
    }
}
?>