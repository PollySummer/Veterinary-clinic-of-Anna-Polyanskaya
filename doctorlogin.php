<?php

session_start();

include("include/connection.php");

if(isset($_POST['login'])){ // Corrected isset() check for login
    $uname=$_POST['uname'];
    $password=$_POST['pass'];

    $error = array();

    $q="SELECT * FROM doctors WHERE username='$uname' AND password='$password'";
    $qq = mysqli_query($connect,$q);

    if(empty($uname)){
        $error['login'] = "Введіть логін";
    } else if(empty($password)){
        $error['login'] = "Введіть пароль";
    } else if(mysqli_num_rows($qq) == 0){ // Check if query returned any rows
        $error['login'] = "Невірні дані!";
    } else {
        $row = mysqli_fetch_array($qq);

        if($row['status'] == 'Pending'){
            $error['login'] = "Зачекайте підтвердження від адміністратора.";
        } else if($row['status'] == "Rejected"){
            $error['login'] = "Спробуйте ще раз пізніше";
        } else {
            echo "<script>alert('Готово!')</script>";
            $_SESSION['doctor'] = $uname;
            header("Location: doctor/index.php");
            exit();
        }
    }
}

if(isset($error['login'])){
    $s=$error['login'];
    $show="<h5 class='text-center alert alert-danger'>$s</h5>";
} else {
    $show="";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Include Bootstrap CSS -->
    <style>
        body {
            background-image: url('img/background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .login-form {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-form h5 {
            margin-bottom: 20px;
        }
        .login-form .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <?php include("include/header.php"); ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-form">
                    <h5 class="text-center">Вхід Лікаря</h5>
                    <?php echo $show; ?>
                    <form method="post">
                        <div class="form-group">
                            <label>Логін</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Ввведіть логін">
                        </div>
                        <div class="form-group">
                            <label>Пароль</label>
                            <input type="password" name="pass" class="form-control" placeholder="Ввведіть пароль">
                        </div>
                        <input type="submit" name="login" class="btn btn-success btn-block" value="Увійти">
                        <p class="text-center mt-3">В мене немає акаунту <a href="apply.php">Зареєструватися!</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and dependencies (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
