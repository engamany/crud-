<?php
session_start();
 require_once "inc/dbConnection.php"; 
require_once "inc/header.php";

if(isset($_GET['id']))
{
    $id=$_GET['id'];

    $query="SELECT * FROM `POSTS` WHERE ID=$id";
    $runQuery=mysqli_query($conn,$query);
    $post=mysqli_fetch_assoc($runQuery);

    
}

?>









<div class="container mt-5">

<?php if(isset($_SESSION['errors'])) {?>

<div class="alert alert-danger w-50">
<?php foreach($_SESSION['errors'] as $error) {?>
    <p><?php echo $error?></p>
    <?php } unset($_SESSION['errors'])?>
</div>

<?php }?>


<form action="handlers/handle-updatepost.php?id=<?php echo $post['id']?>" method="post" enctype="multipart/form-data">
<div class="mb-3">
  <label  class="form-label">Title</label>
  <input value="<?php echo $post['title']?>" required name="title" type="text" class="form-control">
</div>
<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea  name="description" class="form-control"  rows="3">
    <?php echo $post['description']?>

  </textarea>
</div>
 
<div class="mb-3">
  <label class="form-label"> Image </label>
  <input name="image" class="form-control" type="file" >
</div>
   <button class="btn btn-primary" type="submit" name="submit">Add</button>
</form>
</div>














<?php

require_once "inc/footer.php";

?>