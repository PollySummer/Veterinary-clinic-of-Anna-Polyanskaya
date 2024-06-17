<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Сторінка адміністратора</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0-beta3/css/bootstrap.min.css" rel="stylesheet"> <!-- Include Bootstrap CSS -->
</head>
<body>
    <?php 
    include("../include/header.php");
    include("../include/connection.php");

    if (!isset($_SESSION['admin'])) {
        header("Location: ../login.php");
        exit();
    }

    $ad = $_SESSION['admin'];

    $query = "SELECT * FROM admin WHERE username='$ad'";
    $res = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($res);

    $username = $row['username'];
    $profile = $row['profile'];

    if (isset($_POST['update'])) {
        $profile = $_FILES['profile']['name'];

        if (!empty($profile)) {
            $query = "UPDATE admin SET profile='$profile' WHERE username='$ad'";
            $result = mysqli_query($connect, $query);

            if ($result) {
                move_uploaded_file($_FILES['profile']['tmp_name'], "img/$profile");
                $_SESSION['profile'] = $profile; // Update session variable if needed
                // Add a timestamp to force image refresh
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
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 style="margin-top: 20px">Адміністратор <?php echo $username; ?> </h4>

                                <form method="post" enctype="multipart/form-data">
                                    <?php  
                                    if (file_exists("img/$profile")) {
                                        echo "<img src='img/$profile' class='col-md-12' style='height: 250px; width: 450px;'>";
                                    } else {
                                        echo "<img src='img/admin.webp' class='col-md-12' style='height: 250px; width: 450px;'>";
                                    }
                                    ?>
                                    <br><br>
                                    <div class="form-group">
                                        <label>Оновити дані</label>
                                        <input type="file" name="profile" class="form-control">
                                    </div>
                                    <br>
                                    <input type="submit" name="update" value="Оновити фото" class="btn btn-success">
                                </form>
                            </div>
                            <div class="col-md-6">
                                <?php 
                                if (isset($_POST['change'])) {
                                    $uname = $_POST['uname'];

                                    if (!empty($uname)) {
                                        $query = "UPDATE admin SET username='$uname' WHERE username='$ad'";
                                        $res = mysqli_query($connect, $query);

                                        if ($res) {
                                            $_SESSION['admin'] = $uname;
                                        }
                                    }
                                }
                                ?>
                                <form method="post">
                                    <label style="margin-top: 23px; margin-bottom: 10px">Змінити ім'я</label>
                                    <input type="text" name="uname" class="form-control" autocomplete="off">
                                    <input type="submit" name="change" class="btn btn-success" value="Зберегти" style="margin-top: 10px">
                                </form>
                                <br>
                                <?php
                                if (isset($_POST['update_pass'])) {
                                    $old_pass = $_POST['old_pass'];
                                    $new_pass = $_POST['new_pass'];
                                    $conf_pass = $_POST['conf_pass'];

                                    $error = array();

                                    $old = mysqli_query($connect, "SELECT * FROM admin WHERE username='$ad'");
                                    $row = mysqli_fetch_array($old);
                                    $pass = $row['password'];

                                    if (empty($old_pass)) {
                                        $error['p'] = "Введіть старий пароль";
                                    } else if (empty($new_pass)) {
                                        $error['p'] = "Введіть новий пароль";
                                    } else if (empty($conf_pass)) {
                                        $error['p'] = "Підтвердіть пароль";
                                    } else if ($old_pass != $pass) {
                                        $error['p'] = "Невірний пароль";
                                    } else if ($new_pass != $conf_pass) {
                                        $error['p'] = "Паролі не співпадають";
                                    }

                                    if (count($error) == 0) {
                                        $query = "UPDATE admin SET password='$new_pass' WHERE username='$ad'";
                                        mysqli_query($connect, $query);
                                    }
                                }

                                if (isset($error['p'])) {
                                    $e = $error['p'];
                                    $show = "<h5 class='text-center alert alert-danger'>$e</h5>";
                                } else {
                                    $show = "";
                                }
                                ?>
                                <form method="post">
                                    <h5 class="text-center my-4">Змінити пароль</h5>
                                    <div>
                                        <?php echo $show; ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Старий пароль</label>
                                        <input type="password" name="old_pass" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Новий пароль</label>
                                        <input type="password" name="new_pass" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Підтвердити</label>
                                        <input type="password" name="conf_pass" class="form-control">
                                    </div>
                                    <input type="submit" name="update_pass" value="Оновити пароль" class="btn btn-success" style="margin-top: 10px">
                                </form>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</body>
</html>
