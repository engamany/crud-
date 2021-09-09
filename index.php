<?php
session_start();
 require_once "inc/dbConnection.php";

 $query="SELECT * FROM `POSTS`";
 $runQuery=mysqli_query($conn,$query);

 $posts=mysqli_fetch_all($runQuery,MYSQLI_ASSOC);



?>


<div class="container py-5">
  <?php if(!isset($_SESSION['email'])) {?>
    <a class="btn btn-primary" href="login.php">Login</a>
    <?php }?>
    <?php if(isset($_SESSION['email'])) {?>
    <a class="btn btn-primary" href="logout.php">Logout</a>
    <?php }?>

<?php if(isset($_SESSION['email'])) {?>
    <a class="btn btn-primary float-end" href="addpost.php">Add post</a>
   <?php }?> 
    <div class="row">
 <?php foreach($posts as $post) {?>
    <div class="col-md-4">
     <img class="img-fluid" src="uploads/<?php echo $post['img']?>" alt="">
    <h1><?php echo $post['title']?></h1>
    
    <a class="btn btn-info" href="showDetails.php?id=<?php echo $post['id']?>">Show-Details</a>
     <?php if(isset($_SESSION['email'])) {?>
    <a class="btn btn-success" href="updatepost.php?id=<?php echo $post['id']?>">Update</a>
    <a class="btn btn-danger" href="deletepost.php?id=<?php echo $post['id']?>">Delete</a>
    <?php }?>
</div>
   <?php }?>

    </div>
</div>

<?php
require_once "inc/header.php";
?>











<?php
require_once "inc/footer.php";
?>