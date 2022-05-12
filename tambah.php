<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">UPLOAD EBOOK</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
 
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="tambah.php">Upload</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
	<div class="container" style="margin-top:20px">
		<h2>Data Ebook</h2>
		<hr>
		
		<?php
		if(isset($_POST['submit'])){
			$id_buku	    = $_POST['id_buku'];
			$judul			= $_POST['judul'];
			$tahun	        = $_POST['tahun'];
			$jml_unduhan	= $_POST['jml_unduhan'];
            $bahasa			= $_POST['bahasa'];
			$kd_penulis	    = $_POST['kd_penulis'];
			$kd_penerbit	= $_POST['kd_penerbit'];

			$book_file_name = $_FILES['book_file']['name'];
			$book_file_tmp_name = $_FILES['book_file']['tmp_name'];
			$path = "book/".$book_file_name;

			$cek = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='$id_buku'") or die(mysqli_error($conn));
			
			if(mysqli_num_rows($cek) == 0){
				$buku = mysqli_query($conn, "INSERT INTO buku(id_buku, judul, tahun, jml_unduhan, bahasa, book_file,kd_penerbit, kd_penulis, status_buku)
                                     VALUES('$id_buku', '$judul', '$tahun', '$jml_unduhan', '$bahasa', '$book_file_name', '$kd_penerbit', '$kd_penulis', 1)") 
                                     or die(mysqli_error($conn));
									 
				move_uploaded_file($book_file_tmp_name, $path);					 
				
				if($buku){
					echo '<script>alert("Berhasil menambahkan data."); document.location="tambah.php";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
			}else{
				echo '<div class="alert alert-warning">Gagal, ID ebook sudah terdaftar.</div>';
			}
		}
		?>
		
		<form action="tambah.php" method="post" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">ID EBOOK</label>
				<div class="col-sm-10">
					<input type="text" name="id_buku" class="form-control" size="4" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">JUDUL</label>
				<div class="col-sm-10">
					<input type="text" name="judul" class="form-control" required>
				</div>
			</div>
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">TAHUN TERBIT</label>
				<div class="col-sm-10">
					<input type="text" name="tahun" class="form-control" required>
				</div>
			</div>
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">JUMLAH UNDUHAN</label>
				<div class="col-sm-10">
					<input type="number" name="jml_unduhan" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">BAHASA</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input type="radio" class="form-check-input" name="bahasa" value="Indonesia" required>
						<label class="form-check-label">Indonesia</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="bahasa" value="English" required>
						<label class="form-check-label">English</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">FILE BUKU</label>
				<div class="col-sm-10">
					<input type="file" name="book_file"  required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">KODE PENULIS</label>
				<div class="col-sm-10">
					<input type="number" name="kd_penulis" class="form-control" required>
				</div>
			</div>
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">KODE PENERBIT</label>
				<div class="col-sm-10">
					<input type="number" name="kd_penerbit" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
				</div>
			</div>
		</form>
		
	</div>
    <br></br>
    <div class="container" style="margin-top:20px">
		<h2>Data Penulis</h2>
		
		<hr>
		
		<?php
		if(isset($_POST['submit_penulis'])){
			$nama_penulis	= $_POST['nama_penulis'];
			$umur	        = $_POST['umur'];
			
			$cek = mysqli_query($conn, "SELECT * FROM penulis WHERE nama='$nama_penulis'") or die(mysqli_error($conn));
			
			if(mysqli_num_rows($cek) == 0){
				$penulis = mysqli_query($conn, "INSERT INTO penulis(nama, umur)
                                     VALUES('$nama_penulis', '$umur')") 
                                     or die(mysqli_error($conn));
				
				if($penulis){
					echo '<script>alert("Berhasil menambahkan data."); document.location="tambah.php";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
			}else{
				echo '<div class="alert alert-warning">Gagal, ID ebook sudah terdaftar.</div>';
			}
		}
		?>
		
		<form action="tambah.php" method="post">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NAMA PENULIS</label>
				<div class="col-sm-10">
					<input type="text" name="nama_penulis" class="form-control" required>
				</div>
			</div>
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">UMUR PENULIS</label>
				<div class="col-sm-10">
					<input type="number" name="umur" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit_penulis" class="btn btn-primary" value="SIMPAN">
				</div>
			</div>
		</form>
	</div>

    <br></br>


    <div class="container" style="margin-top:20px">
		<h2>Data Penerbit</h2>
		<hr>
		<?php
		if(isset($_POST['submit_penerbit'])){
			$nama_penerbit	= $_POST['nama_penerbit'];
			$alamat	        = $_POST['alamat'];
			
			$cek = mysqli_query($conn, "SELECT * FROM penerbit WHERE nama='$nama_penerbit'") or die(mysqli_error($conn));
			
			if(mysqli_num_rows($cek) == 0){
				$penerbit = mysqli_query($conn, "INSERT INTO penerbit(nama, alamat)
                                     VALUES('$nama_penerbit', '$alamat')") 
                                     or die(mysqli_error($conn));
				
				if($penerbit){
					echo '<script>alert("Berhasil menambahkan data."); document.location="tambah.php";</script>';
				}else{
					echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
				}
			}else{
				echo '<div class="alert alert-warning">Gagal, ID ebook sudah terdaftar.</div>';
			}
		}
		?>
		
		<form action="tambah.php" method="post">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NAMA</label>
				<div class="col-sm-10">
					<input type="text" name="nama_penerbit" class="form-control" required>
				</div>
			</div>
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">ALAMAT</label>
				<div class="col-sm-10">
					<input type="text" name="alamat" class="form-control" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit_penerbit" class="btn btn-primary" value="SIMPAN">
				</div>
			</div>
		</form>
	</div>

    <br></br><br></br>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
</body>
</html>