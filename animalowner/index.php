<?php
session_start();
  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Власник тварини</title>
</head>
<body>
	<?php
	include("../include/header.php");
	include("../include/connection.php");
	?>

	<div class="container-fluid">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2" style="margin-left: -30px;">
					<?php
						include("sidenav.php");
					?>
				</div>

				<div class="col-md-10">
					<h5 class="my-3">Дошка власника тварини</h5>
					<div class="col-md-12">
						<div class="row">
							<div class="row">
								<div class="col-md-3 bg-info mx-2" style="height: 150px;">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												<h5 class="text-white my-4">Мій Профіль</h5>
											</div>
											<div class="col-md-4">
												<a href="profile.php">
													<i class="fa fa-user-circle fa-3x my-4" style="color: white;"></i>
												</a>
											</div>

										</div>
									</div>
								</div>
								<div class="col-md-3 bg-warning mx-2" style="height: 150px;">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												<h5 class="text-white my-4">Записатися на прийом</h5>
											</div>
											<div class="col-md-4">
												<a href="appointment.php">
													<i class="fa fa-calendar fa-3x my-4" style="color: white;"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3 bg-success mx-2" style="height: 150px;">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-8">
												<h5 class="text-white my-4">Мої рахунки</h5>
											</div>
											<div class="col-md-4">
												<a href="invoice.php">
													<i class="fa fa-file-invoice-dollar fa-3x my-4" style="color: white;"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


						<?php 
							if(isset($_POST['send'])){
								$title = $_POST['send'];
								$message = $_POST['message'];

							} if(empty($title)){

							} else if(empty($message)){

							} else{

								$user = $_SESSION['animalowner'];

								$query = "INSERT INTO report(title,message,username,date_send) VALUES('$title','$message','$user',NOW())";


								$res = mysqli_query($connect,$query);

								if($res){
									echo "<script>alert('Скарга успішно відправлена!')</script>";
								}
							}
						 ?>

						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									
								</div>
								<div class="col-md-6 mt-4 p-5 bg-info rounded my-5">
									<h5 class="text-center my-2">Поскаржитися</h5>
									<form method="post">
										<label>Назва</label>
										<input type="text" name="title" autocomplete="off" class="form-control" placeholder="Введіть назву">

										<label>Зміст скарги</label>
										<input type="text" name="message" autocomplete="off" class="form-control" placeholder="Опишіть проблему">

										<input type="submit" name="send" value="Надіслати" class="btn btn-success my-2">
									</form>
								</div>
								<div class="col-md-3">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>