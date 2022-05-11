<?php include "includes/header.php" ?>

<div class="container mt-4">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to <a href='dashboard.php'>dashboard!</a><small>&nbsp;<?php echo $_SESSION['username']; ?></small>
                        </h1>
                    </div>
                </div>
    <?php
    if(isset($_GET['source'])) {
        $source = $_GET['source']; 
    } else {
        $source = '';
    }

    if($source=='edit_image'){
        include "edit_image.php";
    }
    if($source=='add_image'){
        include "add_image.php";
    }

?>
        <div class="container-fluid">

            <h2 class="text-center mt-4">All Image</h2> 
            <span><a href='view_all_images.php?source=add_image'>Add New Image</a></span>      
            <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Document</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>

            <?php
            if (!is_admin($_SESSION['username'])){
            $query = "select * from images where image_user_id={$_SESSION['user_id']}";
            } else {
                $query = "select * from images";
            }
            $sel_images = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($sel_images)) {
            $image_id = $row['image_id'];
            $image_document = $row['image_document'];

                echo "<tr>";
                echo "<td>$image_id</td>";
                echo "<td>doc</td>";
                echo "<td><a href='view_all_images.php?source=edit_image&edit_image={$image_id}'>Edit</a></td>";
                echo "<td><a href='view_all_images.php?delete={$image_id}'>Delete</a></td>";
                echo "</tr>";
        }

            ?>

            </tbody>
            </table>
        </div>
 </div>


<?php
//delete image query
if(isset($_GET['delete'])) {
    $log_action="image deleted";
    $the_image_id = mysqli_real_escape_string($connection,$_GET['delete']);

    $query = "DELETE FROM images where image_id = {$the_image_id} ";
    create_log($_SESSION['username'], $_SESSION['user_id'], $log_action);
    $del_image_query = mysqli_query($connection, $query);
    header("location: view_all_images.php");

}

?>