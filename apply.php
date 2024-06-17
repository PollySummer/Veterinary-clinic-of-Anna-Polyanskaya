<?php
	include("include/connection.php");

	if(isset($_POST['apply'])){

		$firstname = $_POST['fname'];
		$surname = $_POST['sname'];
		$username = $_POST['uname'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$phone = $_POST['phone'];
		$speciality = $_POST['speciality'];
		$password = $_POST['pass'];
		$confirm_password = $_POST['con_pass'];

		$error = array();

		if(empty($firstname)){
			$error['apply'] = "Введіть ім'я";
		} else if(empty($surname)){
			$error['apply'] = "Введіть прізвище";
		} else if(empty($username)){
			$error['apply'] = "Введіть ім'я користувача";
		} else if(empty($email)){
			$error['apply'] = "Введіть електронну пошту";
		} else if($gender == ""){
			$error['apply'] = "Оберіть стать";
		} else if(empty($phone)){
			$error['apply'] = "Введіть номер телефону";
		} else if($speciality == ""){
			$error['apply'] = "Оберіть спеціальність";
		} else if(empty($password)){
			$error['apply'] = "Введіть пароль";
		} else if(empty($confirm_password)){
			$error['apply'] = "Підтвердіть пароль";
		} else if($confirm_password != $password){
			$error['apply'] = "Паролі не співпадають";
		}

		if(count($error) == 0){
			$query = "INSERT INTO doctors (firstname, surname, username, email, gender, phone, speciality, password, salary, data_reg, status, profile) 
					  VALUES ('$firstname', '$surname', '$username', '$email', '$gender', '$phone', '$speciality', '$password', '0', NOW(), 'Pendding', 'doctor.jpg')";

			$result = mysqli_query($connect, $query);

			if($result){
				echo "<script>alert('Реєстрація пройшла успішно!');</script>";
				header("Location: doctorlogin.php");
			} else{
				echo "<script>alert('Ой! Сталася помилка!');</script>";
			}
		}
	}

	if(isset($error['apply'])){
		$s = $error['apply'];
		$show = "<h5 class='text-center alert alert-danger'>$s</h5>";
	} else{
		$show = "";
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Реєстрація Лікаря</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Include Bootstrap CSS -->
    <style>
        body {
            background-image: url('img/background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .registration-form {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .registration-form h5 {
            margin-bottom: 20px;
        }
        .registration-form .form-group label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <?php include("include/header.php"); ?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="registration-form">
                    <h5 class="text-center">Реєстрація Лікаря</h5>
                    <?php echo $show; ?>

                    <form method="post">
                        <div class="form-group">
                            <label>Прізвище</label>
                            <input type="text" name="fname" class="form-control" autocomplete="off" placeholder="Введіть прізвище" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Ім'я</label>
                            <input type="text" name="sname" class="form-control" autocomplete="off" placeholder="Введіть ім'я" value="<?php if(isset($_POST['sname'])) echo $_POST['sname']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Логін</label>
                            <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Введіть логін" value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Електронна пошта</label>
                            <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Введіть електронну пошту" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Оберіть стать</label>
                            <select name="gender" class="form-control">
                                <option value="">Оберіть стать</option>
                                <option value="Жіноча">Жіноча</option>
                                <option value="Чоловіча">Чоловіча</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Телефон</label>
                            <input type="tel" name="phone" class="form-control" autocomplete="off" placeholder="Введіть номер телефону" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Оберіть спеціальність</label>
                            <select name="speciality" class="form-control">
                                <option value="">Оберіть спеціальність</option>
                                <option value="Хірург">Хірург</option>
                                <option value="Фельдшер">Фельдшер</option>
                                <option value="Терапевт">Терапевт</option>
                                <option value="Грумер">Грумер</option>
                                <option value="Вет. аптекар">Вет. аптекар</option>
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
                        <button type="submit" name="apply" class="btn btn-success btn-block">Зареєструватися</button>
                        <p class="text-center mt-3">В мене вже є акаунт <a href="doctorlogin.php">Увійти!</a></p>
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
