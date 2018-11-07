<?php
	require 'Controller.php';
	//require_once 'koneksi.php';
	$controller = new controller();

	$nim=$_GET['nim'];
	
	$result = $controller->ambil_data($nim);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
		$nim = $row['nim'];
		$depan = $row['depan'];
		$belakang = $row['belakang'];
		$email = $row['email'];
		$kelas = $row['kelas'];
		$ttl = $row['ttl'];
		$checkhobi = explode(", ", $row['hobi']);
		$checkfilm = explode(", ", $row['genre']);
		$checkwisata = explode(", ", $row['wisata']);
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
	<title>Edit Data</title>
</head>
<body>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12" style="margin: 10px 0 0 0">
				<nav class="navbar navbar-expand-lg navbar-light bg-primary">
				 
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  <div class="collapse navbar-collapse" id="navbarNav">
				    <ul class="navbar-nav">
				      <li class="nav-item">
				        <a class="nav-link" href="dashboard.php">Dashboard</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="">New Data</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="profile.php">Lihat Profil</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="controller.php?logout=true" style="color:red">Logout</a>
				      </li>
				    </ul>
				  </div>
				</nav>
			</div>
		</div>
	</div>	

	<div class="container">
		<div class="row justify-content-center">
			<div class="" style="margin: 10px 0 0 0">
				<div class="card">
					<div class="card-body">
						
						
						<?php $controller->edit(); ?>

						<h2>Edit Data Mahasiswa</h2>
						<table>
							<form action="" method="post">
								<tr>
									<td>NIM</td>
									<td> : </td>
									<td><input type="text" name="nim" value="<?php echo $nim; ?>"></td>
								</tr>
								<tr>
									<td>Nama Depan</td>
									<td> : </td>
									<td><input type="text" name="depan" value="<?php echo $depan; ?>"></td>
								</tr>
								<tr>
									<td>Nama Belakang</td>
									<td> : </td>
									<td><input type="text" name="belakang" value="<?php echo $belakang; ?>"></td>
								</tr>
								<tr>
									<td>E-mail</td>
									<td> : </td>
									<td><input type="text" name="email" value="<?php echo $email; ?>"></td>
								</tr>
								<tr>
									<td>Kelas</td>
									<td> : </td>
									<td><input type="text" name="kelas" value="<?php echo $kelas; ?>"></td>
								</tr>
								<tr>
									<td>Hobby</td>
									<td> : </td>
									<td>
										<input type="checkbox" name="hobi[]" value="Membaca" <?php in_array('Membaca', $checkhobi) ? print "checked" : ""; ?>>Membaca<br>
										<input type="checkbox" name="hobi[]" value="Menulis" <?php in_array('Menulis', $checkhobi) ? print "checked" : ""; ?>>Menulis<br>
										<input type="checkbox" name="hobi[]" value="Menggambar" <?php in_array('Menggambar', $checkhobi) ? print "checked" : ""; ?>>Menggambar<br>
										
									</td>
								</tr>
								<tr>
									<td>Genre Film</td>
									<td> : </td>
									<td>
										<input type="checkbox" name="genre[]" value="Horror" <?php in_array('Horror', $checkfilm) ? print "checked" : ""; ?>>Horror<br>
										<input type="checkbox" name="genre[]" value="Anime" <?php in_array('Anime', $checkfilm) ? print "checked" : ""; ?>>Anime<br>
										<input type="checkbox" name="genre[]" value="Action" <?php in_array('Action', $checkfilm) ? print "checked" : ""; ?>>Action<br>
										<input type="checkbox" name="genre[]" value="Drama" <?php in_array('Drama', $checkfilm) ? print "checked" : ""; ?>>Drama<br>
										
									</td>
								</tr>
								<tr>
									<td>Tempat Wisata</td>
									<td> : </td>
									<td>
										<input type="checkbox" name="wisata[]" value="Bali" <?php in_array('Bali', $checkwisata) ? print "checked" : ""; ?>>Bali<br>
										<input type="checkbox" name="wisata[]" value="Tanjung Selor" <?php in_array('Tanjung Selor', $checkwisata) ? print "checked" : ""; ?>>Tanjung Selor<br>
										<input type="checkbox" name="wisata[]" value="Jakarta" <?php in_array('Jakarta', $checkwisata) ? print "checked" : ""; ?>>Jakarta<br>
										<input type="checkbox" name="wisata[]" value="Lombok" <?php in_array('Lombok', $checkwisata) ? print "checked" : ""; ?>>Lombok<br>
										
									</td>
								</tr>
								<tr>
									<td>Tanggal Lahir</td>
									<td> : </td>
									<td><input type="date" name="ttl" value="<?php echo $ttl; ?>"></td>
								</tr>
								<tr>
									<td><input type="submit" name="editdata" value="Edit Data"></td>
								</tr>
							</form>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>	