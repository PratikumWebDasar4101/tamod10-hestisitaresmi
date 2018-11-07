<?php
	require 'Controller.php';

	$controller = new controller();

	$username=$_GET['username'];
	
	$result = $controller->datapass($username);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
		$username = $row['username'];
		$password = $row['password'];
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
	<title>Edit Password</title>
</head>
<body>

	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="" style="margin: 10px 0 0 0">
				<nav class="navbar navbar-expand-lg navbar-light bg-primary">
				  
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				   
				        <a class="nav-link" href="dashboard.php" style="color:black">Dashboard</a>|
				      
				        <a class="nav-link" href="newData.php" style="color:black">New Data</a>|
				     
				        <a class="nav-link" href="profile.php" style="color:black">Lihat Profil</a>|
				     
				        <a class="nav-link" href="controller.php?logout=true" style="color:red">Logout</a>
				      
				    
				 
				</nav>
			</div>
		</div>
	</div>	

	<div class="container">
		<div class="row justify-content-center">
			<div class="" style="margin: 10px 0 0 0">
				<div class="card">
					<div class="card-body">
					<form action="" method="post">
						<input type="hidden" name="username" value="<?php echo $username; ?>">
						Password : 
						<input type="password" name="password" value="<?php echo $password; ?>" class="form-control">
						New Password : 
						<input type="password" name="newpassword" class="form-control">
						<input type="submit" name="editpass" value="Save Password" class="" style="margin-top: 10px; margin-bottom: 10px;">
					</form>
						<?php $controller->editpass(); ?>

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