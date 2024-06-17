<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Профіль Лікаря</title>
</head>
<body>

    <?php
    include("../include/header.php");
    include("../include/connection.php");

    if (!isset($_SESSION['doctor'])) {
        header("Location: ../login.php");
        exit();
    }

    $doc = $_SESSION['doctor'];
    $query = "SELECT * FROM doctors WHERE username = '$doc'";
    $res = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($res);

    $profile = $row['profile'];

    if (isset($_POST['upload'])) {
        $profile = $_FILES['img']['name'];

        if (!empty($profile)) {
            $query = "UPDATE doctors SET profile='$profile' WHERE username='$doc'";
            $result = mysqli_query($connect, $query);

            if ($result) {
                move_uploaded_file($_FILES['img']['tmp_name'], "img/$profile");
                // Update the $profile variable to include the timestamp
                $profile .= '?t=' . time();
            }
        }
    }
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left: -30px;">
                    <?php include("sidenav.php"); ?>
                </div>
                <div class="col-md-10">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 style="margin-top: 20px">Профіль Лікаря <?php echo $doc; ?></h4>
                                    <form method="post" enctype="multipart/form-data">
                                        <?php
                                        if (!empty($profile) && file_exists("img/" . $profile)) {
                                            echo "<img src='img/$profile' class='col-md-12' style='height: 250px; width: 450px;'>";
                                        } else {
                                            echo "<img src='img/default_profile.jpg' class='col-md-12' style='height: 250px; width: 450px;'>";
                                        }
                                        ?>
                                        <br><br>
                                        <div class="form-group">
                                            <label>Оновити фото</label>
                                            <input type="file" name="img" class="form-control">
                                        </div>
                                        <input type="submit" name="upload" value="Оновити фото" class="btn btn-success mt-2">
                                    </form>

                                    <div class="my-3">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th colspan="2" class="text-center">Деталі</th>
                                            </tr>

                                            <tr>
                                                <td>Ім'я</td>
                                                <td><?php echo $row['surname']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Прізвище</td>
                                                <td><?php echo $row['firstname']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Ім'я користувача</td>
                                                <td><?php echo $row['username']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Електронна пошта</td>
                                                <td><?php echo $row['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Номер телефону</td>
                                                <td><?php echo $row['phone']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Стать</td>
                                                <td><?php echo $row['gender']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Спеціалізація</td>
                                                <td><?php echo $row['speciality']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Заробітна плата</td>
                                                <td><?php echo $row['salary']; ?> грн</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-center my-2">Змінити ім'я користувача</h5>
                                    <?php
                                    if(isset($_POST['change_uname'])){
                                        $uname = $_POST['uname'];
                                        if(!empty($uname)){
                                            $query = "UPDATE doctors SET username='$uname' WHERE username='$doc'";
                                            $res = mysqli_query($connect, $query);

                                            if ($res) {
                                                $_SESSION['doctor'] = $uname;
                                            }
                                        }
                                    }
                                    ?>
                                    <form method="post">
                                        <label>Змінити ім'я користувача</label>
                                        <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Введіть ім'я користувача">
                                        <input type="submit" name="change_uname" class="btn btn-success my-2" value="Змінити ім'я">
                                    </form>
                                    <br><br>

                                    <h5 class="text-center my-2">Змінити пароль</h5>

                                    <?php
                                    if(isset($_POST['change_pass'])){
                                        $old = $_POST['old_pass'];
                                        $new = $_POST['new_pass'];
                                        $con = $_POST['con_pass'];

                                        $ol = "SELECT * FROM doctors WHERE username = '$doc'";
                                        $ols = mysqli_query($connect, $ol);
                                        $row = mysqli_fetch_array($ols);

                                        if($old != $row['password']){
                                            echo "<p>Неправильний старий пароль</p>";
                                        } else if(empty($new)){
                                            echo "<p>Новий пароль не може бути порожнім</p>";
                                        } else if($con != $new){
                                            echo "<p>Паролі не збігаються</p>";
                                        } else{
                                            $query = "UPDATE doctors SET password = '$new' WHERE username='$doc'";
                                            mysqli_query($connect,$query);
                                            echo "<p>Пароль успішно змінено</p>";
                                        }
                                    }
                                    ?>
                                    <form method="post">
                                        <div class="form-group">
                                            <label>Старий пароль</label>
                                            <input type="password" name="old_pass" class="form-control" autocomplete="off" placeholder="Введіть старий пароль">
                                        </div>
                                        <div class="form-group">
                                            <label>Новий пароль</label>
                                            <input type="password" name="new_pass" class="form-control" autocomplete="off" placeholder="Введіть новий пароль">
                                        </div>
                                        <div class="form-group">
                                            <label>Підтвердіть пароль</label>
                                            <input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Введіть пароль для підтвердження">
                                        </div>
                                        <input type="submit" name="change_pass" class="btn btn-success text-white mt-2" value="Змінити пароль">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>

</body>
</html>
