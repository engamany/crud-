<?php
session_start();
require_once "../inc/dbConnection.php";


if(isset($_POST['submit']) && isset($_GET['id'])){
   
   $title=trim($_POST['title']);
   $desc= trim($_POST['description']);
   $image=$_FILES['image'];
   $id = $_GET['id'];

   $imageName=$image['name'];
   $imageTmpName=$image['tmp_name'];
   $imageError=$image['error'];
   $imageSize=$image['size'];
   $imageSizeMb=$imageSize/(1024**2);
   $ext=pathinfo($imageName,PATHINFO_EXTENSION);
   $errors=[];

   if(empty($title))
   {
       $errors[]="Title is Required";
   } else if (strlen($title)<3 || strlen($title)>255)
   {
    $errors[]="Title Length between [3-255]";
   } else if(is_numeric($title))
   {
    $errors[]="Title must String";
   }

   if(empty($desc))
   {
       $errors[]="Description is Required";
   } else if (strlen($desc)<10 || strlen($desc)>500)
   {
    $errors[]="Description Length between [10-500]";
   } 

//    if($imageError>0)
//    {
//        $errors[]="Error while uploading";
//    } else if (!in_array(strtolower($ext),['jpg','png','jpeg','gif'])){
//            $errors[]="Must image";
//   } else if($imageSizeMb > 1) {
//       $errors[]="Image max size 1mb";
//   }

 if(empty($errors))
 {  
     if(!empty($imageName))
     {
        $rand=uniqid();
        $imgNewName="$rand.$ext";
        move_uploaded_file($imageTmpName,"../uploads/$imgNewName");
      echo $imgNewName,$title,$desc , $id;
        $query="UPDATE `POSTS` SET `title`='$title',`description`='$desc',`img`='$imgNewName'where id=$id";
         
         $runQuery=mysqli_query($conn,$query);
     var_dump($runQuery);
       header("location:../index.php");
     } else {
        $query="UPDATE `POSTS` SET `title`='$title',`description`='$desc'where id=$id";
        $runQuery=mysqli_query($conn,$query);
    var_dump($runQuery);
   
      header("location:../index.php");
     }
     
       
 } else {
  $_SESSION['errors']=$errors;
   header("location:../updatepost.php?id=$id");

 }



}




?>