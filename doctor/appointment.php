<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Всього записів</title>
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
				<h5 class="text-center">Всього записів</h5>

				<?php
				$query = "SELECT * FROM appointment WHERE status = 'Pending'";
				$res = mysqli_query($connect, $query);

				$output = "";

				$output .= "
				<table class='table table-bordered'>
				<tr>
				<th>Id</th>
				<th>Кличка тварини</th>
				<th>Прізвище та ім'я власника тварини</th>
				<th>Телефон</th>
				<th>Симптоми</th>
				<th>Дата запису</th>
				<th>Дата створення запису</th>
				<th>Дії</th>
				</tr>
				";

				if (mysqli_num_rows($res) < 1) {
					$output .= "
					<tr>
						<td class='text-center' colspan='8'>Записи на прийом відсутні</td>
					</tr>
					";
				} else {
					while ($row = mysqli_fetch_array($res)) {
						$output .= "
						<tr>
						<td>" . $row['id'] . "</td>
						<td>" . $row['aname'] . "</td>
						<td>" . $row['ownername'] . "</td>
						<td>" . $row['phone'] . "</td>
						<td>" . $row['symptoms'] . "</td>
						<td>" . $row['appointment_date'] . "</td>
						<td>" . $row['date_booked'] . "</td>
						<td>
							<a href='discharge.php?id=" . $row['id'] . "'>
							<button class='btn btn-info'>Переглянути</button>
							</a>
						</td>
						</tr>
						";
					}
				}

				$output .= "</table>";

				echo $output;
				?>
			</div>
		</div>
	</div>
</div>

</body>
</html>
