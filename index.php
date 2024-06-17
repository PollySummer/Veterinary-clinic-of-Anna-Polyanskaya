<!DOCTYPE html>
<html>
<head>
	<title>Veterinary Clinic Home page</title>
</head>
<body>
	<?php
include("include/header.php");
?>

<div style="margin-top: 50px"></div>

<div class="container">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-3 mx-1 shadow">
				 <img src="img/moreinfo.jpg" style="width: 100%; height: 230px">

				 <h5 class="text-center">Дізнатися більше!</h5>

				 <a href="aboutus.php">
				 	<button class="btn btn-success my-3" style="margin-left: 30%">Про нас</button>
				 </a>
			</div>
			<div class="col-md-4 mx-1 shadow">
				 <img src="img/patient.jpg" style="width: 80%;  height: 230px; margin-left:7%; ">

				 <h5 class="text-center">Запишись на прийом онлайн!</h5>

				 <a href="account.php">
				 	<button class="btn btn-success my-3" style="margin-left: 30%">Зареєструватися</button>
				 </a>
			</div>
			<div class="col-md-4 mx-1 shadow">
				 <img src="img/vetdoctor.jpeg" style="width: 90%; height: 230px; margin-left: 5%">

				 <h5 class="text-center">Приходь на роботу!</h5>

				 <a href="apply.php">
				 	<button class="btn btn-success my-3" style="margin-left: 30%">Залишити заявку</button>
				 </a>
			</div>
		</div>
	</div>
</div>
</body>
</html>