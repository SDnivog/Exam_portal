<?php

if(isset($_FILES['file'])){

$file = $_FILES['file'];
$filename = $file['name'];
$des = "previewimages/".$filename;

if(move_uploaded_file($file['tmp_name'],$des)){
  echo "<img src='$des' style='height:200px; width:100%'>";
}




}






 ?>
