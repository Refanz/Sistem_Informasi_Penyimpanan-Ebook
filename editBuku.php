<?php 

include('config.php'); 

error_reporting(0);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Buku</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">EDIT LIBRARY</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
 
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="tambah.php">Tambah</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container" style="margin-top:20px">
	
		<h2>Edit Buku</h2>
		<hr>
		
		<?php
		//jika sudah mendapatkan parameter GET id dari URL
		if(isset($_GET['id'])){
			//membuat variabel $id untuk menyimpan id dari GET id di URL
			$id = $_GET['id'];
			
			//query ke database SELECT tabel buku berdasarkan id = $id
			$select = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='$id'") or die(mysqli_error($conn));
			
			//jika hasil query = 0 maka muncul pesan error
			if(mysqli_num_rows($select) == 0){
				echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				exit();
			//jika hasil query > 0
			}else{
				//membuat variabel $data dan menyimpan data row dari query
				$data = mysqli_fetch_assoc($select);
			}
		}
		?>
		
		<?php
		//jika tombol simpan di tekan/klik
		if(isset($_POST['submit'])){
			$id_buku	    = $_POST['id_buku'];
			$judul			= $_POST['judul'];
			$tahun	        = $_POST['tahun'];
			$jml_unduhan	= $_POST['jml_unduhan'];
            $bahasa			= $_POST['bahasa'];
			$kd_penulis	    = $_POST['kd_penulis'];
			$kd_penerbit	= $_POST['kd_penerbit'];
			
			$new_book_file = $_FILES['new_book_file']['name'];
			$temp_new_book_file = $_FILES['new_book_file']['tmp_name'];

			$old_book_file = $_POST['old_book_file'];
		
			$path = "";
			$buku = "";

			if(empty($new_book_file)){
				$path = "book/".$old_book_file;
				$buku = mysqli_query($conn, "UPDATE buku SET judul='$judul', tahun='$tahun', jml_unduhan='$jml_unduhan', 
						bahasa='$bahasa', book_file='$old_book_file', kd_penulis='$kd_penulis', kd_penerbit='$kd_penerbit' WHERE id_buku='$id'") or die(mysqli_error($conn));
			}else if(!empty($new_book_file)){
				$path = "book/".$new_book_file;
				$buku = mysqli_query($conn, "UPDATE buku SET judul='$judul', tahun='$tahun', jml_unduhan='$jml_unduhan', 
						bahasa='$bahasa', book_file='$new_book_file', kd_penulis='$kd_penulis', kd_penerbit='$kd_penerbit' WHERE id_buku='$id'") or die(mysqli_error($conn));
                unlink("book/".$old_book_file);
				move_uploaded_file($temp_new_book_file, $path);
			}
			
			if($buku){
				echo '<script>alert("Berhasil menyimpan data."); document.location="editBuku.php?id='.$id.'";</script>';
			}else{
				echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
			}
		}
		?>
		
		<form action="editBuku.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">JUDUL</label>
				<div class="col-sm-10">
					<input type="text" name="judul" class="form-control" size="4" value="<?php echo $data['judul']; ?>"  required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">TAHUN TERBIT</label>
				<div class="col-sm-10">
					<input type="text" name="tahun" class="form-control" value="<?php echo $data['tahun']; ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">JUMLAH UNDUHAN</label>
				<div class="col-sm-10">
					<input type="text" name="jml_unduhan" class="form-control" value="<?php echo $data['jml_unduhan']; ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">BAHASA</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input type="radio" class="form-check-input" name="bahasa" value="Indonesia" <?php if($data['bahasa'] == 'INDONESIA'){ echo 'checked'; } ?> required>
						<label class="form-check-label">INDONESIA</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="bahasa" value="English" <?php if($data['bahasa'] == 'ENGLISH'){ echo 'checked'; } ?> required>
						<label class="form-check-label">ENGLISH</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">FILE BUKU</label>
				<div class="col-sm-10">
					<input type="file" name="new_book_file">
					<input type="text" name="old_book_file" value="<?=$data['book_file'];?>" hidden>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">KODE PENULIS</label>
				<div class="col-sm-10">
					<input type="number" name="kd_penulis" class="form-control" value="<?php echo $data['kd_penulis']; ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">KODE PENERBIT</label>
				<div class="col-sm-10">
					<input type="number" name="kd_penerbit" class="form-control" value="<?php echo $data['kd_penerbit']; ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="SIMPAN">
					<a href="index.php" class="btn btn-warning">KEMBALI</a>
				</div>
			</div>
		</form>
		
	</div>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
</body>
</html>