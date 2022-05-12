<?php

include('config.php');

$id = $_GET['id'];
$path_book_file = $_GET['book_file'];

$sql = "SELECT * FROM buku WHERE id_buku = '$id'";
$query = mysqli_query($conn, $sql);

$path = "book/".$path_book_file;

$data_buku = mysqli_fetch_assoc($query);

$id_buku = $id;
$judul			= $data_buku['judul'];
$tahun	        = $data_buku['tahun'];
$jml_unduhan	= $data_buku['jml_unduhan'];
$bahasa			= $data_buku['bahasa'];
$kd_penulis	    = $data_buku['kd_penulis'];
$kd_penerbit	= $data_buku['kd_penerbit'];

$sql2 = "UPDATE buku SET judul='$judul', tahun='$tahun', jml_unduhan='$jml_unduhan', bahasa='$bahasa', book_file='$path', kd_penulis='$kd_penulis', kd_penerbit='$kd_penerbit', status_buku = 1 WHERE id_buku='$id_buku'";
$query2 = mysqli_query($conn, $sql2);

if($query2){
    echo '<script>alert("Data buku berhasil disetujui!!!"); document.location="approve.php";</script>';
}else{
    echo '<script>alert("Data buku gagal disetujui!!!"); document.location="approve.php";</script>';
}

?>