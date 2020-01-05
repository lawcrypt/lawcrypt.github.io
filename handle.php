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
        $file_uploads = Off;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($file_uploads == Off) {
        echo "<script>window.location = 'error.html'</script>";
    // if everything is ok, try to upload file
    } 
    else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            exec("./main -encrypt '$target_file'");
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $file_suff = substr($_FILES["fileToUpload"]["name"], 0, strrpos($_FILES["fileToUpload"]["name"], '.', -1));
            $split_src = "/Users/josephz/downloads/programming/attorney_secret_sharing/joezbub.github.io/uploads/";
            $tmp = $split_src . $file_suff . "-key-1.dat";
            shell_exec("mv $tmp /Users/josephz/Dropbox/Lawyer_Data/");
            $tmp = $split_src . $file_suff . "-key-2.dat";
            shell_exec("mv $tmp /Users/josephz/GoogleDrive/Lawyer_Data/");
            $tmp = $split_src . $file_suff . "-key-3.dat";
            shell_exec("mv $tmp /Users/josephz/OneDrive/Lawyer_Data/");

            $tmp = $split_src . $file_suff . "-split-1.dat";
            shell_exec("mv $tmp /Users/josephz/Dropbox/Lawyer_Data/");
            $tmp = $split_src . $file_suff . "-split-2.dat";
            shell_exec("mv $tmp /Users/josephz/GoogleDrive/Lawyer_Data/");
            $tmp = $split_src . $file_suff . "-split-3.dat";
            shell_exec("mv $tmp /Users/josephz/OneDrive/Lawyer_Data/");
            header("Location: split.html");
            include("split.html");
        } 
        else {
            echo "<script>window.location = 'error.html'</script>";
        }
    }
?>