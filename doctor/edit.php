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
                <h5 class="text-center mt-2">Дані пацієнта</h5>

                <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];

                    $query = "SELECT * FROM animalowner WHERE id='$id'";
                    $res = mysqli_query($connect, $query);

                    if ($row = mysqli_fetch_array($res)) {
                        ?>
                        <div class="row">
                            <div class="col-md-8">
                            	<h5 class="text-center">Деталі</h5>
                                <h5 class="my-3">Id: <?php echo $row['id']; ?></h5>
                                <h5 class="my-3">Власник: <?php echo $row['ownername']; ?></h5>
                                <h5 class="my-3">Електронна пошта: <?php echo $row['email']; ?></h5>
                                <h5 class="my-3">Телефон: <?php echo $row['phone']; ?></h5>
                                <h5 class="my-3">Кличка тварини: <?php echo $row['aname']; ?></h5>
                                <h5 class="my-3">Вид тварини: <?php echo $row['animal']; ?></h5>
                                <h5 class="my-3">Стать: <?php echo $row['gender']; ?></h5>
                            </div>
                            <div class="col-md-4">
                                <h5 class="text-center">Оновити дані пацієнта</h5>
                                	<?php

                                	if(isset($_POST['update'])){
                                        $ownername = $_POST['ownername'];
                                        $email = $_POST['email'];
                                        $phone = $_POST['phone'];
                                        $aname = $_POST['aname'];
                                        $animal = $_POST['animal'];
                                        $gender = $_POST['gender'];

                                		$q="UPDATE animalowner SET ownername='$ownername',email='$email',phone='$phone',aname='$aname',animal='$animal',gender='$gender'  WHERE id='$id'";

                                		mysqli_query($connect, $q);
                                	}

                                	  ?>
                                <form method="post">
                                    <label>Введіть прізвище та ім'я власника</label>
                                    <input type="text" name="ownername" class="form-control" autocomplete="off" placeholder="Оновити ім'я" value="<?php echo $row['ownername']?>">
                                    <label>Введіть електронну пошту</label>
                                    <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Оновити ім'я" value="<?php echo $row['email']?>">
                                    <label>Введіть номер телефону</label>
                                    <input type="number" name="phone" class="form-control" autocomplete="off" placeholder="Телефон" value="<?php echo $row['phone']?>">
                                    <label>Введіть кличку тварини</label>
                                    <input type="text" name="aname" class="form-control" autocomplete="off" placeholder="Оновити ім'я" value="<?php echo $row['aname']?>">
                                    <label>Введіть вид тварини</label>
                                    <input type="text" name="animal" class="form-control" autocomplete="off" placeholder="Оновити ім'я" value="<?php echo $row['animal']?>">
                                    <label>Введіть стать</label>
                                    <input type="text" name="gender" class="form-control" autocomplete="off" placeholder="Оновити ім'я" value="<?php echo $row['gender']?>">


                                	<input type="submit" name="update" class="btn btn-info my-3" value="Оновити дані">
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
