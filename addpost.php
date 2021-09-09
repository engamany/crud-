<?php 
session_start();
if(!isset($_SESSION['email']))
{
  header("location:index.php");
}
require_once "inc/header.php";

?>



    


<div class="container mt-5">

<?php if(isset($_SESSION['errors'])) {?>

<div class="alert alert-danger w-50">
<?php foreach($_SESSION['errors'] as $error) {?>
    <p><?php echo $error?></p>
    <?php } unset($_SESSION['errors'])?>
</div>

<?php }?>


<form action="handlers/handle-addpost.php" method="post" enctype="multipart/form-data">
<div class="mb-3">
  <label  class="form-label">Title</label>
  <input required name="title" type="text" class="form-control">
</div>
<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description" class="form-control"  rows="3"></textarea>
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