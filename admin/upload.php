<?php

if(isset($_FILES['file'])){

$file = $_FILES['file'];

 $folderPath = 'preview/';
 
$filename = uniqid().'.png';
$des = $folderPath .$filename;

if(move_uploaded_file($file['tmp_name'],$des)){
  echo "<img src='$des' >";
}




}






 ?>