<?php

include('config.php');

$id = $_GET['id'];
$path_book_file = $_GET['book_file'];

$sql = "DELETE FROM buku WHERE id_buku = '$id'";

$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

unlink("book/".$path_book_file);

if($query){
    echo '<script>alert("Data buku berhasil ditolak!!!"); document.location="approve.php";</script>';
}else{
    echo '<script>alert("Data buku gagal ditolak."); document.location="approve.php";</script>';
}

?>