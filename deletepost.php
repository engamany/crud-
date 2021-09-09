<?php

require_once "inc/dbConnection.php";

if(isset($_GET['id']))
{
    $id=$_GET['id'];

 $query="DELETE FROM `POSTS` WHERE ID=$id";
 $runQuery=mysqli_query($conn,$query);
 header("location:index.php");
}


?>