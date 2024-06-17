<?php
session_start();
  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Дошка Лікаря</title>
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
  				<div class="container-fluid">
  					<h5 class="mt-3 mb-2">Дошка Лікаря</h5>
  					<div class="col-md-12">
  						<div class="row">
  							<div class="col-md-3 my-2 bg-info mx-2" style="height: 150px;">
  								<div class="col-md-12">
  									<div class="row">
  										<div class="col-md-8">
  											<h5 class="text-white my-4">Мій профіль</h5>
  										</div>
  										<div class="col-md-4">
  											<a href="profile.php"><i class="fa fa-user-circle fa-3x my-4" style="color: white"></i></a>
  										</div>
  									</div>
  								</div>
  							</div>
  							  <div class="col-md-3 my-2 bg-warning mx-2" style="height: 150px;">
  								<div class="col-md-12">
  									<div class="row">
  										<div class="col-md-8">
                        <?php
                        $app = mysqli_query($connect, "SELECT * FROM appointment WHERE status = 'Pending'");

                        $appoint = mysqli_num_rows($app);
                        ?>
  											<h5 class="text-white my-2" style="font-size: 30px"><?php echo $appoint ?></h5>
  											<h5 class="text-white">Записів</h5>
  											<h5 class="text-white">Всього</h5>
  										</div>
  										<div class="col-md-4">
  											<a href="appointment.php"><i class="fa fa-calendar-plus fa-3x my-4" style="color: white"></i></a>
  										</div>
  									</div>
  								</div>
  							</div>  							
  							  <div class="col-md-3 my-2 bg-success mx-2" style="height: 150px;">
  								<div class="col-md-12">
  									<div class="row">
  										<div class="col-md-8">
                        <?php
                        $p = mysqli_query($connect,"SELECT * FROM animalowner");

                        $pp = mysqli_num_rows($p);
                        ?>
  											<h5 class="text-white my-2" style="font-size: 30px"><?php echo $pp;?></h5>
  											<h5 class="text-white">Пацієнтів</h5>
  											<h5 class="text-white">Всього</h5>
  										</div>
  										<div class="col-md-4">
  											<a href="patient.php"><i class="fa fa-cat fa-3x my-4" style="color: white"></i></a>
  										</div>
  									</div>
  								</div>
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