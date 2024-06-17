<?php
include("include/connection.php");

if(isset($_POST['create'])){
    $fname = $_POST['fname'];
    $sname = $_POST['sname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $aname = $_POST['aname'];
    $gender = $_POST['gender'];
    $animal = $_POST['animal'];
    $password = $_POST['pass'];
    $con_pass = $_POST['con_pass'];

    $error = array();

    if(empty($fname)){
        $error['ac'] = "Введіть ім'я";
    } else if(empty($sname)){
        $error['ac'] = "Введіть прізвище";
    } else if(empty($uname)){
        $error['ac'] = "Введіть логін";
    } else if(empty($email)){
        $error['ac'] = "Введіть електронну адресу";
    } else if(empty($phone)){
        $error['ac'] = "Введіть телефон";
    } else if(empty($aname)){
        $error['ac'] = "Введіть ім'я тварини";
    } else if(empty($gender)){
        $error['ac'] = "Оберіть стать тварини";
    } else if(empty($animal)){
        $error['ac'] = "Оберіть вид тварини";
    } else if(empty($password)){
        $error['ac'] = "Введіть пароль";
    } else if($con_pass != $password){
        $error['ac'] = "Паролі не співпадають";
    }

    if(count($error) == 0){
        $query = "INSERT INTO animalowner (firstname, surname, username, email, phone, aname, gender, animal, password, date_reg, profile) 
                  VALUES ('$fname', '$sname', '$uname', '$email', '$phone', '$aname', '$gender', '$animal', '$password', NOW(), 'patient.jpg')";

        $res = mysqli_query($connect, $query);

        if($res){
            header("Location: clientlogin.php");
        } else{
            echo "<script>alert('failed')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Реєстрація</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-image: url(img/background.jpg); background-repeat: no-repeat; background-size: cover;">
<?php include("include/header.php"); ?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                
            </div>
            <div class="col-md-6 mt-4 p-5 bg-light rounded">
                <h5 class="text-center text-info">Реєстрація власника тварини</h5>

                <form method="post">
                    <div class="form-group">
                        <label>Ім'я</label>
                        <input type="text" name="fname" class="form-control" autocomplete="off" placeholder="Введіть ім'я">
                    </div>

                    <div class="form-group">
                        <label>Прізвище</label>
                        <input type="text" name="sname" class="form-control" autocomplete="off" placeholder="Введіть прізвище">
                    </div>

                    <div class="form-group">
                        <label>Логін</label>
                        <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Введіть логін">
                    </div>

                    <div class="form-group">
                        <label>Електронна адреса</label>
                        <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Введіть електронну адресу">
                    </div>

                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="number" name="phone" class="form-control" autocomplete="off" placeholder="Введіть телефон">
                    </div>

                    <div class="form-group">
                        <label>Кличка тварини</label>
                        <input type="text" name="aname" class="form-control" autocomplete="off" placeholder="Введіть кличку тварини">
                    </div>

                    <div class="form-group">
                        <label>Стать</label>
                        <select name="gender" class="form-control">
                            <option value="">Оберіть стать тварини</option>
                            <option value="Чоловіча">Чоловіча</option>
                            <option value="Жіноча">Жіноча</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Вид тварини</label>
                        <select name="animal" class="form-control">
                            <option value="">Оберіть вид вашої тварини</option>
                            <option value="Собака">Собака</option>
                            <option value="Кіт">Кіт</option>
                            <option value="Гризун">Гризун</option>
                            <option value="Птах">Птах</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Пароль</label>
                        <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Введіть пароль">
                    </div>

                    <div class="form-group">
                        <label>Підтвердіть пароль</label>
                        <input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Підтвердіть пароль">
                    </div>

                    <input type="submit" name="create" value="Зареєструватися" class="btn btn-info btn-block">
                    <p>В мене вже є акаунт. <a href="clientlogin.php">Увійти</a></p>
                </form>
            </div>
            <div class="col-md-3">
                
            </div>
        </div>
    </div>
</div>
</body>
</html>
