<?php
session_start();

include("include/connection.php");

if(isset($_POST['login'])){
$uname = $_POST['uname'];
$pass = $_POST['pass'];

		if(empty($uname)){
		 echo "<script>alert('Введіть логін')</script>";
		} else if(empty($pass)){
		 echo "<script>alert('Введіть пароль')</script>";
		} else{
			$query = "SELECT * FROM animalowner WHERE username='$uname' AND password='$pass'";
			$res = mysqli_query($connect,$query);

			if(mysqli_num_rows($res)==1){
				header("Location: animalowner/index.php");

				$_SESSION['animalowner'] = $uname;
			} else{
				echo "<script>alert('Такого акаунту не існує.')</script>";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Власник тварини</title>
</head>
<body style="background-image: url(img/background.jpg); background-repeat: no-repeat; background-size: cover;">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<?php

include("include/header.php");

  ?>

  <div class="container-fluid">
  	<div class="col-md-12">
  		<div class="row">
  			<div class="col-md-3">
  				
  			</div>
  			<div class="col-md-6 mt-4 p-5 bg-light rounded">
  				<h5 class="text-center">Вхід Власника тварини</h5>

  				<form method="post">
  					<div class="form-group">
  						<label>Ім'я користувача </label>
  						<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Введіть логін">
  					</div>
  					<div class="form-group">
  						<label>Пароль</label>
  						<input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Введіть пароль">
  					</div>
  					<input type="submit" name="login" class="btn btn-info my-3 btn-block" value="Увійти">
  					<p>В мене немає акаунту <a href="account.php">Зареєструватися!</a></p>
  				</form>
  			</div>
  			<div class="col-md-3">
  				
  			</div>
  		</div>
  	</div>
  </div>

</body>
</html>