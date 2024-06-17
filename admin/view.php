<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Дані пацієнта</title>
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
					<h5 class="text-cener my-3">Переглянути дані пацієнта</h5>

					<?php
					if(isset($_GET['id'])){
						$id = $_GET['id'];
						$query = "SELECT * FROM animalowner WHERE id='$id'";
						$res = mysqli_query($connect,$query);
						$row = mysqli_fetch_array($res);
					}
					?>

					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3">
								<div class="col-md-6">
									<?php
									echo "<img src='../animalowner/img/".$row['profile']."' class='col-md-12 my-2'>"
									?>

									<table class="table table-bordered">
										<tr>
											<th class="text-cener" colspan="2">Деталі</th>
										</tr>
										<tr>
											<td>Кличка тварини</td>
											<td><?php echo $row['aname']?></td>
										</tr>
										<tr>
											<td>Вид тварини</td>
											<td><?php echo $row['animal']?></td>
										</tr>
										<tr>
											<td>Стать</td>
											<td><?php echo $row['gender']?></td>
										</tr>
										<tr>
											<td>Прізвище та ім'я власника</td>
											<td><?php echo $row['ownername']?></td>
										</tr>
										<tr>
											<td>Електронна пошта</td>
											<td><?php echo $row['email']?></td>
										</tr>
										<tr>
											<td>Телефон</td>
											<td><?php echo $row['phone']?></td>
										</tr>
										<tr>
											<td>Дата реєстрації</td>
											<td><?php echo $row['date_reg']?></td>
										</tr>
									</table>
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