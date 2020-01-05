<?php
    $files = scandir('uploads', SCANDIR_SORT_DESCENDING);
    $newest_file = "uploads/" . $files[0];
    shell_exec("rm $newest_file");
    header("Location: index.html");
?>