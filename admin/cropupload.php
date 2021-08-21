<?php

        session_start();
        $folderPath = 'Upload/';
        $image_parts = explode(";base64,", $_POST['image']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $filename = uniqid() . '.png';
        $file = $folderPath .$filename;
      
        

        if(file_put_contents($file, $image_base64)){
            $_SESSION['filename1'] = $filename;
        }
        echo json_encode(["image uploaded successfully."]);
?>