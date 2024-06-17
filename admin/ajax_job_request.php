<?php

include("../include/connection.php");

$query = "SELECT * FROM doctors WHERE status='Pendding' ORDER BY data_reg ASC";
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
            <td>".$row['data_reg']."</td>
            <td>
                <div class='row'>
                    <div class='col-md-6'>
                        <button id='approve_".$row['id']."' class='btn btn-success approve'>Підтвердити</button>
                    </div>
                    <div class='col-md-6'>
                        <button id='reject_".$row['id']."' class='btn btn-danger reject'>Відхилити</button>
                    </div>
                </div>
            </td>
        </tr>
    ";
}

$output .= "</table>";

echo $output;

?>
