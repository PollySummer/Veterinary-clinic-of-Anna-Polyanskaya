<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Редагувати дані</title>
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
                <h5 class="text-center">Редагувати дані лікаря</h5>

                <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $query = "SELECT * FROM doctors WHERE id='$id'";
                    $res = mysqli_query($connect, $query);

                    if ($row = mysqli_fetch_array($res)) {
                        ?>
                        <div class="row">
                            <div class="col-md-8">
                            	<h5 class="text-center">Деталі</h5>
                                <h5 class="my-3">ID: <?php echo $row['id']; ?></h5>
                                <h5 class="my-3">Ім'я: <?php echo $row['firstname']; ?></h5>
                                <h5 class="my-3">Прізвище: <?php echo $row['surname']; ?></h5>
                                <h5 class="my-3">Ім'я користувача: <?php echo $row['username']; ?></h5>
                                <h5 class="my-3">Електронна пошта: <?php echo $row['email']; ?></h5>
                                <h5 class="my-3">Телефон: <?php echo $row['phone']; ?></h5>
                                <h5 class="my-3">Стать: <?php echo $row['gender']; ?></h5>
                                <h5 class="my-3">Спеціалізація: <?php echo $row['speciality']; ?></h5>
                                <h5 class="my-3">Дата реєстрації: <?php echo $row['data_reg']; ?></h5>
                                <h5 class="my-3">Заробітна плата: <?php echo $row['salary']; ?> грн</h5>
                            </div>
                            <div class="col-md-4">
                                <h5 class="text-center">Оновити дані лікаря</h5>
                                	<?php

                                	if(isset($_POST['update'])){
                                        $firstname = $_POST['firstname'];
                                        $surname = $_POST['surname'];
                                        $email = $_POST['email'];
                                        $phone = $_POST['phone'];
                                        $gender = $_POST['gender'];
                                        $speciality = $_POST['speciality'];
                                        $salary = $_POST['salary'];

                                		$q="UPDATE doctors SET firstname='$firstname',surname='$surname',email='$email',phone='$phone',gender='$gender',speciality='$speciality',salary='$salary' WHERE id='$id'";

                                		mysqli_query($connect, $q);
                                	}

                                	  ?>
                                <form method="post">
                                    <label>Введіть ім'я</label>
                                    <input type="text" name="firstname" class="form-control" autocomplete="off" placeholder="Ім'я" value="<?php echo $row['firstname']?>">
                                    <label>Введіть прізвище</label>
                                    <input type="text" name="surname" class="form-control" autocomplete="off" placeholder="Прізвище" value="<?php echo $row['surname']?>">
                                    <label>Введіть електронну пошту</label>
                                    <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Електронну пошта" value="<?php echo $row['email']?>">
                                    <label>Введіть телефон</label>
                                    <input type="text" name="phone" class="form-control" autocomplete="off" placeholder="Телефон" value="<?php echo $row['phone']?>">
                                    <label>Введіть стать</label>
                                    <input type="text" name="gender" class="form-control" autocomplete="off" placeholder="Стать" value="<?php echo $row['gender']?>">
                                    <label>Введіть спеціальність</label>
                                    <input type="text" name="speciality" class="form-control" autocomplete="off" placeholder="Спеціальність" value="<?php echo $row['speciality']?>">
                                	<label>Введіть заробітну плату</label>
                                	<input type="number" name="salary" class="form-control" autocomplete="off" placeholder="Заробітна плата" value="<?php echo $row['salary']?>">

                                	<input type="submit" name="update" class="btn btn-info my-3" value="Зберегти">
                                </form>
                            </div>
                        </div>
                        <?php
                    } else {
                        echo "<p>Doctor not found.</p>";
                    }
                } else {
                    echo "<p>ID not set.</p>";
                }
                ?>

            </div>
        </div>
    </div>
</div>
</body>
</html>
