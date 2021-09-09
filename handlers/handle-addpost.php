<?php
session_start();
require_once "../inc/dbConnection.php";


if(isset($_POST['submit'])){
   
   $title=$_POST['title'];
   $desc=$_POST['description'];
   $image=$_FILES['image'];
   echo $title,$desc;
   print_r($image);

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

   if($imageError>0)
   {
       $errors[]="Error while uploading";
   } else if (!in_array(strtolower($ext),['jpg','png','jpeg','gif'])){
           $errors[]="Must image";
  } else if($imageSizeMb > 1) {
      $errors[]="Image max size 1mb";
  }

 if(empty($errors))
 {  
     $rand=uniqid();
     $imgNewName="$rand.$ext";
     move_uploaded_file($imageTmpName,"../uploads/$imgNewName");

     $query="INSERT INTO `POSTS` (`title`,`description`,`img`) VALUES
     ('$title','$desc','$imgNewName')";
      
      $runQuery=mysqli_query($conn,$query);

    header("location:../index.php");
       
 } else {
  $_SESSION['errors']=$errors;
   header("location:../addpost.php");

 }



}


?>