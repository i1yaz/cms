<?php 

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