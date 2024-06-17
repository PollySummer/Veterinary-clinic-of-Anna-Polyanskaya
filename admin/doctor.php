<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Лікарі</title>
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
					<h5 class="text-center mt-3 mb-2" >Всього лікарів</h5>
					<?php

						$query = "SELECT * FROM doctors WHERE status = 'Approved' ORDER BY data_reg ASC";

						$res = mysqli_query($connect, $query);


						$output = "";

$output .= "
    <table class='table table-bordered'>
    <tr>
        <th>ID</th>
        <th>Ім'я</th>
        <th>Прізвище</th>
        <th>Ім'я користувача</th>
        <th>Електронна пошта</th>
        <th>Стать</th>
        <th>Номер телефону</th>
        <th>Спеціальність</th>
        <th>Заробітна плата</th>
        <th>Дата регістрації</th>
        <th>Action</th>
    </tr>
";

if (mysqli_num_rows($res) < 1) {
    $output .= "
        <tr>
            <td colspan='10' class='text-center'>Запитів ще немає</td>
        </tr>
    ";
}

while ($row = mysqli_fetch_array($res)) {
    $output .= "
        <tr>
            <td>".$row['id']."</td>
            <td>".$row['firstname']."</td>
            <td>".$row['surname']."</td>
            <td>".$row['username']."</td>
            <td>".$row['email']."</td>
            <td>".$row['gender']."</td>
            <td>".$row['phone']."</td>
            <td>".$row['speciality']."</td>
            <td>".$row['salary']."</td>
            <td>".$row['data_reg']."</td>
            <td>
               <a href='edit.php?id=".$row['id']."'>
               <button class='btn btn-info'>Редагувати</button >
               <button class='btn btn-danger mt-2'>Видалити</button >
               </a>
            </td>
        </tr>
    ";
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