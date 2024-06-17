<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Перевірити запис пацієнта</title>
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
				<h5 class="text-center my-2">Записів всього</h5>

				<?php
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					$query = "SELECT * FROM appointment WHERE id='$id'";
					$res = mysqli_query($connect, $query);
					$row = mysqli_fetch_array($res);
				}
				?>

				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<table class="table table-bordered">
								<tr>
									<td colspan="2" class="text-center">Деталі запису</td>
								</tr>
								<tr>
									<td>Кличка тварини</td>
									<td><?php echo $row['aname']; ?></td>
								</tr>
								<tr>
									<td>Власник тварини</td>
									<td><?php echo $row['ownername']; ?></td>
								</tr>
								<tr>
									<td>Телефон</td>
									<td><?php echo $row['phone']; ?></td>
								</tr>
								<tr>
									<td>Симптоми</td>
									<td><?php echo $row['symptoms']; ?></td>
								</tr>
								<tr>
									<td>Дата запису</td>
									<td><?php echo $row['appointment_date']; ?></td>
								</tr>
							</table>
						</div>
						<div class="col-md-6">
							<h5 class="text-center my-1">Рахунок</h5>
							<?php
							if (isset($_POST['send'])) {
								$fee = $_POST['fee'];
								$description = $_POST['description'];

								if (empty($fee)) {
									echo "<script>alert('Будь ласка, введіть суму рахунку.')</script>";
								} elseif (empty($description)) {
									echo "<script>alert('Будь ласка, введіть опис рахунку.')</script>";
								} else {
									$doc = $_SESSION['doctor'];
									$aname = $row['aname'];

									$query = "INSERT INTO income(doctor,patient,date_discharge,amount_paid,description) VALUES('$doc','$aname',NOW(),'$fee','$description')";
									$res = mysqli_query($connect, $query);

									if ($res) {
										echo "<script>alert('Рахунок успішно надіслано!')</script>";
										
										mysqli_query($connect, "UPDATE appointment SET status='Discharge' WHERE id='$id'");
									}

								}
							}
							?>
							<form method="post">
								<label>Рахунок</label>
								<input type="number" name="fee" class="form-control" autocomplete="off" placeholder="Введіть рахунок пацієнта">

								<label>Опис</label>
								<input type="text" name="description" class="form-control" autocomplete="off" placeholder="Введіть опис">

								<input type="submit" name="send" value="Надіслати" class="btn btn-info my-2">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
