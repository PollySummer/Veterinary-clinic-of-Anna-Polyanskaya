<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Записатися на прийом</title>
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
                <h5 class="text-center my-2">Записатися на прийом</h5>

                <?php
                $pat = $_SESSION['animalowner'];
                $sel = mysqli_query($connect, "SELECT * FROM animalowner WHERE username = '$pat'");

                if ($row = mysqli_fetch_array($sel)) {
                    $aname = $row['aname'];
                    $ownername = $row['ownername'];
                    $phone = $row['phone'];
                } else {
                    echo "<script>alert('Користувача не знайдено. Переконайтеся, що ви ввійшли у систему.')</script>";
                    exit();
                }

                if (isset($_POST['book'])) {
                    $date = $_POST['date'];
                    $sym = $_POST['sym'];

                    if (empty($sym)) {
                        echo "<script>alert('Будь ласка, введіть симптоми.')</script>";
                    } else {
                        $query = "INSERT INTO appointment(aname, ownername, symptoms, phone, appointment_date, status, date_booked) 
                                  VALUES ('$aname', '$ownername', '$sym', '$phone', '$date', 'Pending', NOW())";

                        $res = mysqli_query($connect, $query);

                        if ($res) {
                            echo "<script>alert('Ви успішно записалися на прийом!')</script>";
                        } else {
                            echo "<script>alert('Помилка під час запису на прийом. Спробуйте ще раз.')</script>";
                        }
                    }
                }
                ?>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form method="post">
                                <label>Дата прийому</label>
                                <input type="date" name="date" class="form-control" required>

                                <label>Симптоми</label>
                                <input type="text" name="sym" class="form-control" autocomplete="off" placeholder="Введіть симптоми" required>
                                <input type="submit" name="book" class="btn btn-info my-2" value="Записатися">
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
