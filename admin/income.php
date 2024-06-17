<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Прибуток</title>
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
                <h5 class="text-center my-2">Загальний прибуток</h5>

                <?php
                $query = "SELECT * FROM income";

                $res = mysqli_query($connect, $query);

                $output = "";

                $output .= "
                <table class='table table-bordered'>
                <tr>
                    <th>id</th>
                    <th>Лікар</th>
                    <th>Пацієнт</th>
                    <th>Дата виписки</th>
                    <th>Вартість обслуговування</th>
                </tr>
                ";

                if (mysqli_num_rows($res) < 1) {
                    $output .= "
                    <tr>
                        <td class='text-center' colspan=''>Дані про виписаних пацієнтів відсутні.</td>
                    </tr>
                    ";
                } else {
                    while ($row = mysqli_fetch_array($res)) {
                        $output .= "
                        <tr>
                            <td>".$row['id']."</td>
                            <td>".$row['doctor']."</td>
                            <td>".$row['patient']."</td>
                            <td>".$row['date_discharge']."</td>
                            <td>".$row['amount_paid']."</td>
                        </tr>
                        ";
                    }
                }

                $output .= "
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
