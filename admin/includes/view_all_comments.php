<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Post Title</th>
            <th>Author</th>
            <th>Email</th>
            <th>In Response to</th>
            <th>Status</th>
            <th>Date</th>
            <th>Approve</th>
            <th>unapprove</th>
            <th>Delete</th>
        </tr>

    </thead>
    <tbody>
        <?php 
                        $query = "SELECT * FROM comments ORDER BY com_date DESC";
                        $result_comments = mysqli_query($connection,$query);
                        while ($row = mysqli_fetch_assoc($result_comments)) {
                            $com_id = $row['com_id'];
                            $com_post_id = $row['com_post_id'];
                            $com_author = $row['com_author'];
                            $com_email = $row['com_email'];
                            // $com_content = $row['com_content'];
                            $com_status = $row['com_status'];
                            $com_date = $row['com_date'];
                            

                            echo "<tr>";
                            echo "<td>{$com_id}</td>";

                            $query = "SELECT * FROM posts WHERE post_id=$com_post_id";
                            $result_post_id = mysqli_query($connection,$query);
    
                            while ( $row = mysqli_fetch_assoc($result_post_id) ) {
                            
                            $post_title = $row['post_title'];
                            echo "<td>{$post_title}</td>";
                            }
                            echo "<td>{$com_author}</td>";
                            echo "<td>{$com_email}</td>";
                            // echo "<td >{$com_content}</td>";
                            $query = "SELECT * FROM posts WHERE post_id=$com_post_id";
                            $result_search = mysqli_query($connection,$query);
                            if (!$result_search) {
                                die("QUERY FAILED ". mysqli_error($connection));
                            }
                            while ($rows = mysqli_fetch_assoc($result_search) ) {
                                $post_id = $rows['post_id'];
                                $post_title = $rows['post_title'];
                                echo "<td><a href='../post.php?p_id=$post_id'>$post_title<a></td>";
                            }

                            echo "<td>{$com_status}</td>";
                            echo "<td>{$com_date}</td>";
                            echo "<td><a class='glyphicon glyphicon-ok'  href='comments.php?approve={$com_id}'></a> </td>";
                            echo "<td><a class='glyphicon glyphicon-remove' href='comments.php?unapprove={$com_id}'></a> </td>";
                            echo "<td><a class='glyphicon glyphicon-trash' href='comments.php?delete={$com_id}'></a> </td>";
                            echo "</tr>";
                        }
                        ?>
        <?php 

                        if (isset($_GET['unapprove'])) {
                            $the_get_unapprove = $_GET['unapprove'];
                            $unapprove_query = "UPDATE comments SET com_status='unapproved' WHERE com_id=$the_get_unapprove";
                            $result_unapprove = mysqli_query($connection,$unapprove_query);
                            if (!$result_unapprove) {
                                die ("QUERY FAILED ". mysqli_error($connection));
                            }
                            header("Location: comments.php");
                        }

                        if (isset($_GET['approve'])) {
                            $the_get_approve = $_GET['approve'];
                            $approve_query = "UPDATE comments SET com_status='approved' WHERE com_id=$the_get_approve";
                            $result_approve = mysqli_query($connection,$approve_query);
                            if (!$result_approve) {
                                die ("QUERY FAILED ". mysqli_error($connection));
                            }
                            header("Location: comments.php");
                        }


                        if (isset($_GET['delete'])) {
                            $the_comment_id = $_GET['delete'];
                            $delete_query = "DELETE FROM comments WHERE com_id={$the_comment_id}";
                            $result_delete = mysqli_query($connection,$delete_query);
                            if (!$result_delete) {
                                die ("QUERY FAILED ". mysqli_error($connection));
                            }
                            header("Location: comments.php");
                        }
                        ?>
    </tbody>
</table>