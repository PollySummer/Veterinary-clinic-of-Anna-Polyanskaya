<?php
session_start();
include("include/connection.php");

if (isset($_POST['login'])) {

    $username = $_POST['uname'];
    $password = $_POST['pass'];

    $error = array();

    if (empty($username)) {
        $error['admin'] = "Введіть логін";
    } else if (empty($password)) {
        $error['admin'] = "Введіть пароль";
    }

    if (count($error) == 0) {
        $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) == 1) {
            echo "<script>alert('Ви увійшли як Адміністратор')</script>";

            $_SESSION['admin'] = $username;

            header("Location:admin/index.php");
            exit();
        } else {
            echo "<script>alert('Неправильний логін або пароль')</script>";
        }
    }
}

?>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body style="background-image: url(img/background.jpg); background-repeat: no-repeat; background-size: cover;">

    <?php
    include("include/header.php");
    ?>

    <div style="margin-top: 20px"></div>

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 mt-4 p-5 bg-light rounded">
                    <img src="img/admin.png" class="col-md-12" style="width: 240px; display: block; margin-left: auto; margin-right: auto;">
                    <h4 style="text-align: center; margin-top: 10px">Вхід Адміністратора</h4>
                    <form method="post" class="my-2">
                        <div>
                            <?php

                            if (isset($error['admin'])) {
                                $sh = $error['admin'];

                                $show= "<h4  class='alert alert-danger'>$sh</h4>";


                            } else {
                                $show = "";
                            }

                            echo $show;

                            ?>
                        </div>

                        <div class="form-group mb-4">
                            <label class="fw-bold">Логін</label>
                            <input type="text" name="uname" class="form-control mt-2" autocomplete="off" placeholder="Введіть логін">
                        </div>
                        <div class="form-group mb-4">
                            <label class="fw-bold">Пароль</label>
                            <input type="password" name="pass" placeholder="Введіть пароль" class="form-control mt-2">
                        </div>

                        <input type="submit" name="login" class="btn btn-success btn-block" value="Увійти">
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>

</body>
</html>
