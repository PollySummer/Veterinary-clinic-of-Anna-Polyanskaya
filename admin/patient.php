<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Всього пацієнтів</title>
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
					<h5 class="text-center my-3">Пацієнти ветеринарної клініки</h5>

					<?php
					$query = "SELECT * FROM animalowner";
					$res = mysqli_query($connect,$query);

					$output = "";
					$output .= "
					<table class='table table-bordered'>
					<tr>
					<td>Id</td>
					<td>Кличка тварини</td>
					<td>Вид тварини</td>
					<td>Стать тварини</td>
					<td>Прізвище та ім'я власника</td>
					<td>Електронна пошта</td>
					<td>Номер телефону</td>
					<td>Дата реєстрації</td>
					<td> </td>
					</tr>
					";

					if(mysqli_num_rows($res)<1){
						$output .= "
						<tr>
						<td class='text-center'>Пацієнтів немає.</td>
						</tr>
						";
					}

					while($row = mysqli_fetch_array($res)){
						$output .="
						<tr>
							<td>".$row['id']."</td>
							<td>".$row['aname']."</td>
							<td>".$row['animal']."</td>
							<td>".$row['gender']."</td>
							<td>".$row['ownername']."</td>
							<td>".$row['email']."</td>
							<td>".$row['phone']."</td>
							<td>".$row['date_reg']."</td>
							<td>
							<a href='view.php?id=".$row['id']."'>
							<button class='btn btn-info'>Детальніше</button >
							</a>
							<button class='btn btn-danger mt-2'>Видалити</button >
							</td>
						</tr>
						";
					}

					$output .="
							</tr>
						</table>
					";
					echo $output;
					?>
				</div>
			</div>
		</div>
	</div>

</body>
</html>