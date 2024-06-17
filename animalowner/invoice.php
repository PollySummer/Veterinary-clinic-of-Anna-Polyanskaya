<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Мої рахунки</title>
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
				<h5 class="text-center">Мої рахунки</h5>
				<?php
				$pat = $_SESSION['animalowner'];

				$query = "SELECT * FROM animalowner WHERE username='$pat'";
				$res = mysqli_query($connect, $query);

				if (!$res || mysqli_num_rows($res) == 0) {
					echo "<p class='text-center'>Помилка: Власника не знайдено.</p>";
				} else {
					$row = mysqli_fetch_array($res);
					$aname = $row['aname'];

					$querys = mysqli_query($connect, "SELECT * FROM income WHERE patient='$aname'");

					if (!$querys) {
						echo "<p class='text-center'>Помилка: Не вдалося виконати запит.</p>";
					} else {
						$output = "
						<table class='table table-bordered'>
						<tr>
							<th>Id</th>
							<th>Лікар</th>
							<th>Пацієнт</th>
							<th>Дата виписки</th>
							<th>Рахунок</th>
							<th>Деталі</th>
							<th> </th>
						</tr>
						";

						if (mysqli_num_rows($querys) < 1) {
							$output .= "
							<tr>
								<td colspan='7' class='text-center'>Рахунки відсутні.</td>
							</tr>
							";
						} else {
							while ($row = mysqli_fetch_array($querys)) {
								$output .= "
								<tr>
									<td>" . $row['id'] . "</td>
									<td>" . $row['doctor'] . "</td>
									<td>" . $row['patient'] . "</td>
									<td>" . $row['date_discharge'] . "</td>
									<td>" . $row['amount_paid'] . "</td>
									<td>" . $row['description'] . "</td>
									<td>
										<a href='view.php?id=" . $row['id'] . "'>
											<button class='btn btn-info'>Переглянути</button>
										</a>
									</td>
								</tr>
								";
							}
						}

						$output .= "</table>";
						echo $output;
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
</body>
</html>
