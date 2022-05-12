<?php

include("config.php");

if(!empty($_GET['book_file'])){
    $book_file_name = basename($_GET['book_file']);
    $book_file_path = "book/".$book_file_name;

    if(!empty($book_file_name) && file_exists($book_file_path)){
        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$book_file_name");
        header("Content-Type: application/pdf");
        header("Content-Transfer-Encoding: binary");

        //read file
        readfile($book_file_path);
        exit;
    }else{
        echo '<script>alert("Buku tidak ada!!!"); document.location="index.php";</script>';
    }
}
    



?>