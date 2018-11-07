<?php
	class controller{

		function login(){
			require_once 'koneksi.php';
			if (isset($_POST['login'])) {
				$username = $_POST['username'];
				$password = $_POST['password'];

				$sql = "SELECT * FROM user WHERE username='$username' && password='$password'";
				$query = mysqli_query($db, $sql);
				if (mysqli_num_rows($query) == 1) {
					session_start();
					$_SESSION['username'] = $username;
					header("Location: dashboard.php");
				}else{
					echo "<div class='alert alert-danger' role='alert'>";
					echo "Login Gagal !!";
					echo "</div>";
				}
			}
		}

		function registrasi(){
			require_once 'koneksi.php';
			if (isset($_POST['registrasi'])) {
				$nim	 = $_POST['nim'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				

				$sql = "INSERT INTO `user`(`nim`, `username`, `password`) VALUES ('$nim', '$username', '$password')";

				if(mysqli_query($db, $sql)){
					header("Location: index.php");
				}else{
					echo "Error : " . $sql . "<br>" . mysqli_error($db);
				}
			}
		}

		function dashboard(){
			require_once 'koneksi.php';
			$sql = "SELECT mahasiswa.nim, user.username, user.password, mahasiswa.depan, mahasiswa.belakang, mahasiswa.email, mahasiswa.kelas, mahasiswa.hobi, mahasiswa.genre, mahasiswa.wisata, mahasiswa.ttl 
				FROM user JOIN mahasiswa on user.nim=mahasiswa.nim ";

			$result = mysqli_query($db, $sql);

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$nim = $row['nim'];
					echo "<tr>";
					echo "<td>" . $nim . "</td>";
					echo "<td>" . $row['username'] . "</td>";
					echo "<td>" . $row['password'] . "</td>";
					echo "<td>" . $row['depan'] . "</td>";
					echo "<td>" . $row['belakang']  . "</td>";
					echo "<td>" . $row['email']  . "</td>";
					echo "<td>" . $row['kelas']  . "</td>";
					echo "<td>" . $row['hobi']  . "</td>";
					echo "<td>" . $row['genre']  . "</td>";
					echo "<td>" . $row['wisata']  . "</td>";
					echo "<td>" . $row['ttl']  . "</td>";
					echo "<td> <a href='form_edit.php?nim=$nim'>Edit</a> | <a href='controller.php?delete=true&nim=$nim'>Hapus</a> </td>";
					echo "</tr>";
				}
			}else{
				echo "0 result";
			}

			mysqli_close($db);
		}

		function newData(){
			if (isset($_POST['inputdata'])) {

			require_once 'koneksi.php';
				$nim = $_POST['nim'];
				$depan = $_POST['depan'];
				$belakang = $_POST['belakang'];
				$email = $_POST['email'];
				$kelas = $_POST['kelas'];	
				$hobi = $_POST['hobi'];
				$genre = $_POST['genre'];
				$wisata = $_POST['wisata'];
				$ttl = $_POST['ttl'];

				$hobi = implode(", ", $hobi);
				$film = implode(", ", $genre);
				$wisata = implode(", ", $wisata);	

				$sql = "INSERT INTO `mahasiswa`(`nim`, `depan`, `belakang`, `email`, `kelas`, `hobi`, `genre`, `wisata`, `ttl`)
						VALUES ('$nim', '$depan', '$belakang', '$email', '$kelas', '$hobi', '$film', '$wisata', '$ttl')";

				if (mysqli_query($db, $sql)) {
					echo "<br>";
					echo "Data Berhasil di Input";
				}else{
					echo "Error : " . $sql . "<br>" . mysqli_error($db);

				}

			mysqli_close($db);
			}
		}

		function profile(){
			require_once 'koneksi.php';
			session_start();
			$username = $_SESSION['username'];

			$sql = "SELECT * FROM user WHERE username='$username'";

			$result = mysqli_query($db, $sql);

			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$username = $row['username'];
					echo "<tr>";
					echo "<td>" . $row['nim'] . "</td>";
					echo "<td>" . $username . "</td>";
					echo "<td>" . $row['password'] . "</td>";
					echo "<td><a href=editpass.php?username=$username>Edit Password</a></td>";
					echo "</tr>";
				}
			}else{
				echo "0 result";
			}

			mysqli_close($db);
		}

		function delete($nim){
			if (!empty($_GET['nim'])) {
			require_once 'koneksi.php';
				$sql = "DELETE FROM mahasiswa WHERE nim='$nim'";
				if (mysqli_query($db, $sql)) {
					header("Location: dashboard.php");
				}else{
					echo "Error : " . $sql . "<br>" . mysqli_error($conn);
				}
			}
			mysqli_close($db);
		}

		function ambil_data($nim){
				require_once 'koneksi.php';
				$sql = "SELECT * from mahasiswa where nim='$nim'";
				return mysqli_query($db, $sql);

		}

		function edit(){
			if (isset($_POST['editdata'])) {
				$nim = $_POST['nim'];
				$depan = $_POST['depan'];
				$belakang = $_POST['belakang'];
				$email = $_POST['email'];
				$kelas = $_POST['kelas'];	
				$hobi = $_POST['hobi'];
				$genre = $_POST['genre'];
				$wisata = $_POST['wisata'];
				$ttl = $_POST['ttl'];

				$hobi = implode(", ", $hobi);
				$film = implode(", ", $genre);
				$wisata = implode(", ", $wisata);	
				
				$db = new mysqli("localhost", "root", "", "modul8");
				$sql = "UPDATE `mahasiswa` SET `depan`='$depan',`belakang`='$belakang',`email`='$email',
						`kelas`='$kelas',`hobi`='$hobi',`genre`='$film',`wisata`='$wisata',`ttl`='$ttl' WHERE 
						`nim`='$nim'";

				if (mysqli_query($db, $sql)) {
					echo "<br>";
					echo "Data Mahasiswa Berhasil Diubah";
				}else{
					echo "Error : " . $sql . "<br>" . mysqli_error($db);
				}
				mysqli_close($db);
			}
		}

		function datapass($username){
			require_once 'koneksi.php';
			$sql = "SELECT * FROM `user` WHERE username='$username'";
			return mysqli_query($db, $sql);

		}

		function editpass(){
			if (isset($_POST['editpass'])) {
				$username = $_POST['username'];
				$newpass = $_POST['newpassword'];
				$db = new mysqli("localhost", "root", "", "modul8");
				$sql = "UPDATE `user` SET password='$newpass' WHERE username='$username'";

				if (mysqli_query($db, $sql)) {
					echo "<br>";
					echo "Password Berhasil Diubah";
				}else{
					echo "Error : " . $sql . "<br>" . mysqli_error($db);
				}
				mysqli_close($db);
			}
		}

		function cari(){
			require_once 'koneksi.php';
			$cari = $_POST['search'];
			$sql = "SELECT * FROM mahasiswa join user on mahasiswa.nim=user.nim 
			WHERE mahasiswa.nim LIKE '%$cari%'";
			$result = mysqli_query($db, $sql);

			if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$nim=$row['nim'];
				echo "<tr>";
				echo "<td>" . $row['nim'] . "</td>";
				echo "<td>" . $row['username'] . "</td>";
				echo "<td>" . $row['password'] . "</td>";
				echo "<td>" . $row['depan'] . "</td>";
				echo "<td>" . $row['belakang']  . "</td>";
				echo "<td>" . $row['email']  . "</td>";
				echo "<td>" . $row['kelas']  . "</td>";
				echo "<td>" . $row['hobi']  . "</td>";
				echo "<td>" . $row['genre']  . "</td>";
				echo "<td>" . $row['wisata']  . "</td>";
				echo "<td>" . $row['ttl']  . "</td>";
				echo "<td> <a href='form_edit.php?nim=$nim'>Edit</a> | <a href='controller.php?delete=true&nim=$nim'>Hapus</a> </td>";
				echo "</tr>";
			}
			}
		}

		function logout(){
			session_start();
			session_destroy();
			header("Location: index.php");
		}
	}

	$controller = new Controller();
	if (isset($_GET['logout'])) {
		$controller->logout();
	}

	if (isset($_GET['delete'])) {
		$nim = $_GET['nim'];
		$controller->delete($nim);
	}
?>