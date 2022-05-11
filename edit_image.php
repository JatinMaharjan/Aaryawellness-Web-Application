<div class="container mt-4">
<?php
if(isset($_GET['edit_image'])) {
    $the_image_id = $_GET['edit_image'];

    $query = "SELECT * FROM images where image_id = $the_image_id ";
    $sel_images_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($sel_images_query)) {
        $image_id = $row['image_id'];
        $image_no = $row['image_no'];
        $image_document = $row['image_document'];
    }

}


if(isset($_POST['edit_image'])) {
    $image_no = $_POST['image'];
    $image_document = $_FILES['document']['name'];
    $image_document_temp = $_FILES['document']['tmp_name'];

    move_uploaded_file($image_document_temp, "documents/$image_document");

    $allowed_extension = array('jpeg', 'jpg', 'pdf', 'doc', 'docx');
    $filename = $_FILES['document']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    if(!in_array($file_extension, $allowed_extension)){
      echo "only jpg, jpeg, pdf, doc and docx allowed";
    }
    else{

    $query = "UPDATE images SET ";
    $query .="image_no = '{$image_no}', ";
    $query .="image_document = '{$image_document}' ";
    $query .="WHERE image_id = {$the_image_id} ";

    $log_action="Image updated";
    create_log($_SESSION['username'], $_SESSION['user_id'], $log_action);
    $update_image_query = mysqli_query($connection, $query);
    confirm($update_image_query);
    }
}
?>

<div class="container">

<form action="" method="post" enctype="multipart/form-data"> 
<div class="row ">
  
    <div class="col mb-3">
    <label for="inputFile">Upload file</label>
    <input type="file" class="form-control"  
    id="inputFiles" name="document">
  </div>
  <div class="col mb-3">
  <input type="submit" name="edit_image" class="btn btn-primary mt-4" value="Update">
  </div>
   <div class="col mb-3 p-5">
      <p><a href="documents/<?php echo $image_document?>"><?php echo $image_document?></a></p>
  </div>
  </div>
</form>

  <div>


</div>
<hr>