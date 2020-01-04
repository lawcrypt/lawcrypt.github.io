<?php
    
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $file_uploads = On;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));    
    // Check if file already exists
    if (file_exists($target_file)) {
        $file_uploads = Off;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 50000000000) {
        echo "Sorry, your file is too large.";
        $file_uploads = Off;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($file_uploads == Off) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            header("Location: loading.html");
            exec("./main -encrypt '$target_file'");
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            header("Location: split.html");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>