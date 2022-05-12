<?php
//include file config.php
include('config.php');
 
//jika benar mendapatkan GET id dari URL
if(isset($_GET['id'])){
	//membuat variabel $id yang menyimpan nilai dari $_GET['id']
	$id = $_GET['id'];
	//membuat variabel $book_file yang menyimpan nilai dari $_GET['book_file']
	$book_file = $_GET['book_file'];
	
	//melakukan query ke database, dengan cara SELECT data yang memiliki id yang sama dengan variabel $id
	$cek = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='$id'") or die(mysqli_error($conn));

	//jika query menghasilkan nilai > 0 maka eksekusi script di bawah
	if(mysqli_num_rows($cek) > 0){
		//query ke database DELETE untuk menghapus data dengan kondisi id=$id
		$del = mysqli_query($conn, "DELETE FROM buku WHERE id_buku='$id'") or die(mysqli_error($conn));
		//Fungsi di PHP untuk menghapus file
		unlink("book/".$book_file);
		if($del){
			echo '<script>alert("Berhasil menghapus data."); document.location="index.php";</script>';
		}else{
			echo '<script>alert("Gagal menghapus data."); document.location="index.php";</script>';
		}
	}else{
		echo '<script>alert("ID tidak ditemukan di database."); document.location="index.php";</script>';
	}
}else{
	echo '<script>alert("ID tidak ditemukan di database."); document.location="index.php";</script>';
}
 
?>