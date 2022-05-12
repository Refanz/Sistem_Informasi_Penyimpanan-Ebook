<?php 

include('config.php');
 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
    <title>Home</title>
</head>
<body>
    <form action="" method="POST" class="login-email">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">Sistem Penyimpanan Ebook</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
 
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="virHome.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="virTambah.php">Upload</a>
					</li>
                    <li>
                        <div class="input-group">
                            <a href="logout.php" class="btn">Logout</a>
                        </div>
                    </li>
				</ul>
			</div>
		</div>
	</nav>

    
	<div class="container" style="margin-top:20px">
		<?php echo "<h1>Selamat Datang, " . $_SESSION['username'] ."!". "</h1>"; ?>
        <br></br>
		<h2>Daftar Ebook</h2>
		
		<hr>

		<form action="" method="post">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Cari Ebook: </label>
				<div class="col-sm-9">
					<input type="text" name="cari_buku" class="form-control" 
					 placeholder="Cari nama buku.." size="4" autocomplete = "off">
				</div>
				<div class="col-sm-15">
					<input type="submit" name="cariBuku" class="btn btn-primary" value="CARI">
				</div>
			</div>
		</form>
		
		<table class="table table-striped table-hover table-sm table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>NO.</th>
					<th>NAMA EBOOK</th> 
					<th>TAHUN TERBIT</th>
					<th>JUMLAH UNDUHAN</th> 
					<th>BAHASA</th> 
					<th>NAMA PENULIS</th> 
					<th>NAMA PENERBT</th>
					<th>AKSI</th>
				</tr>
			</thead>
			<tbody>
				<?php

				if(isset($_POST['cariBuku'])){
					$cari_buku = $_POST['cari_buku'];
					$buku = mysqli_query($conn, "SELECT A.id_buku, A.judul, A.tahun, A.jml_unduhan, A.bahasa, A.book_file, A.status_buku, B.nama AS nama_penerbit, 
					C.nama AS nama_penulis from buku A INNER JOIN penerbit B ON A.kd_penerbit = B.id_penerbit 
					INNER JOIN penulis C ON A.kd_penulis = C.id_penulis WHERE a.is_delete = 0 and b.is_delete = 0 and c.is_delete = 0 and a.status_buku = 1 
					AND (A.judul LIKE '%".$cari_buku."%')");				
				}else{
					$buku = mysqli_query($conn, "SELECT A.id_buku, A.judul, A.tahun, A.jml_unduhan, A.bahasa, A.book_file, A.status_buku, B.nama AS nama_penerbit, 
										C.nama AS nama_penulis from buku A INNER JOIN penerbit B ON A.kd_penerbit = B.id_penerbit 
										INNER JOIN penulis C ON A.kd_penulis = C.id_penulis WHERE status_buku = 1");
				}

				if(mysqli_num_rows($buku) > 0){
					
					$no = 1;
					
					while($data = mysqli_fetch_array($buku)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$data['judul'].'</td>
							<td>'.$data['tahun'].'</td>
							<td>'.$data['jml_unduhan'].'</td>
							<td>'.$data['bahasa'].'</td>
							<td>'.$data['nama_penulis'].'</td>
							<td>'.$data['nama_penerbit'].'</td>
							<td>
								<a href="download.php?book_file='.$data['book_file'].'" class="badge badge-success">Download</a>
							</td>
						</tr>
						';
						$no++;
					}
				}else{
					echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
				}
				?>
			<tbody>
		</table>
	</div>
    <br> </br>
    
	<div class="container" style="margin-top:20px">
		<h2>Daftar Penulis</h2>
		
		<hr>
		<form action="" method="post">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Cari Penulis: </label>
				<div class="col-sm-9">
					<input type="text" name="cari_penulis" class="form-control" 
					 placeholder="Cari nama penulis.." size="4" autocomplete = "off">
				</div>
				<div class="col-sm-15">
					<input type="submit" name="cariPenulis" class="btn btn-primary" value="CARI">
				</div>
			</div>
		</form>
		
		<table class="table table-striped table-hover table-sm table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>KODE PENULIS</th>
					<th>NAMA PENULIS</th>
					<th>UMUR PENULIS</th>
				</tr>
			</thead>
			<tbody>
			
			<?php

				if(isset($_POST['cariPenulis'])){
					$cari_penulis = $_POST['cari_penulis'];
					$penulis = mysqli_query($conn, "SELECT * FROM penulis WHERE is_delete=0 AND (nama LIKE '%".$cari_penulis."%')");				
				}else{
					$penulis = mysqli_query($conn, "SELECT * FROM penulis WHERE is_delete=0  ORDER BY id_penulis ASC") or die(mysqli_error($conn));
				}	

				if(mysqli_num_rows($penulis) > 0){
					while($data = mysqli_fetch_array($penulis)){
						echo '
						<tr>
							<td>'.$data['id_penulis'].'</td>
							<td>'.$data['nama'].'</td>
							<td>'.$data['umur'].'</td>
						</tr>
						';
				
					}
				}else{
					echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
				}
				?>
			<tbody>
		</table>
	</div>

	    <br> </br>

		<div class="container" style="margin-top:20px">
		<h2>Daftar Penerbit</h2>
		
		<hr>

		<form action="" method="post">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Cari Penerbit: </label>
				<div class="col-sm-9">
					<input type="text" name="cari_penerbit" class="form-control" 
					 placeholder="Cari nama penerbit.." size="4" autocomplete = "off">
				</div>
				<div class="col-sm-15">
					<input type="submit" name="cariPenerbit" class="btn btn-primary" value="CARI">
				</div>
			</div>
		</form>

		
		<table class="table table-striped table-hover table-sm table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>KODE PENERBIT</th>
					<th>NAMA PENERBIT</th>
					<th>ALAMAT PENERBIT</th>
				</tr>
			</thead>
			<tbody>

		<?php
			if(isset($_POST['cariPenerbit'])){
				$cari_penerbit = $_POST['cari_penerbit'];
				$penerbit = mysqli_query($conn, "SELECT * FROM penerbit WHERE is_delete=0 AND (nama LIKE '%".$cari_penerbit."%')");				
			}else{
                $penerbit = mysqli_query($conn, "SELECT * FROM penerbit WHERE is_delete=0 ORDER BY id_penerbit ASC") or die(mysqli_error($conn));
			}	
				if(mysqli_num_rows($penerbit) > 0){
					
					$no = 1;
					
					while($data = mysqli_fetch_array($penerbit)){
						echo '
						<tr>
							<td>'.$data['id_penerbit'].'</td>
							<td>'.$data['nama'].'</td>
							<td>'.$data['alamat'].'</td>
						</tr>
						';
						$no++;
					}
				}else{
					echo '
					<tr>
						<td colspan="6">Tidak ada data.</td>
					</tr>
					';
				}
				?>
			<tbody>
		</table>
		
	</div>
    <br> </br>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
    </form>

</body>
</html>