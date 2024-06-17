<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Власник тварини</title>
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

                $animalowner = $_SESSION['animalowner'];

                // Correct the query to fetch the row based on the username
                $query = "SELECT * FROM animalowner WHERE username='$animalowner'";

                $res = mysqli_query($connect, $query);

                // Check if the query returns a row
                if ($row = mysqli_fetch_array($res)) {
                    // Fetching the user profile was successful
                } else {
                    // Handle the case where no user was found
                    echo "<script>alert('Користувача не знайдено');</script>";
                }
                ?>
            </div>
            <div class="col-md-10">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            if (isset($_POST['upload'])) {
                                $img = $_FILES['img']['name'];

                                if (empty($img)) {
                                    echo "<script>alert('Будь ласка, виберіть зображення');</script>";
                                } else {
                                    $query = "UPDATE animalowner SET profile = '$img' WHERE username='$animalowner'";

                                    $res = mysqli_query($connect, $query);

                                    if ($res) {
                                        move_uploaded_file($_FILES['img']['tmp_name'], "img/$img");
                                    } else {
                                        echo "<script>alert('Помилка при оновленні профілю');</script>";
                                    }
                                }
                            }
                            ?>
                            <h5>Мій профіль</h5>
                            <form method="post" enctype="multipart/form-data">
                                <?php
                                // Check if the 'profile' key exists in the $row array to avoid undefined index errors
                                if (isset($row['profile'])) {
                                    echo "<img src='img/" . $row['profile'] . "' class='col-md-12' style='height: 250px;width: 250px;'>";
                                } else {
                                    echo "<img src='img/default.png' class='col-md-12 style='height: 250px;'>";
                                }
                                ?>
                                <input type="file" name="img" class="form-control my-2">
                                <input type="submit" name="upload" class="btn btn-info" value="Оновити фото">
                            </form>


                            <table class="table table-bordered">
                            	<tr>
                            		<th colspan="2" class="text-center">Мої дані</th>
                            	</tr>
                            	<tr>
                            		<td>Bласник</td>
                            		<td><?php echo $row['ownername']; ?></td>
                            	</tr>
                            	<tr>
                            		<td>Логін</td>
                            		<td><?php echo $row['username']; ?></td>
                            	</tr>
                            	<tr>
                            		<td>Поштова адреса</td>
                            		<td><?php echo $row['email']; ?></td>
                            	</tr>
                            	<tr>
                            		<td>Номер телефону</td>
                            		<td><?php echo $row['phone']; ?></td>
                            	</tr>
                            	<tr>
                            		<td>Ім'я тварини</td>
                            		<td><?php echo $row['aname']; ?></td>
                            	</tr>
                            	<tr>
                            		<td>Стать тварини</td>
                            		<td><?php echo $row['gender']; ?></td>
                            	</tr>
                            	<tr>
                            		<td>Вид тварини</td>
                            		<td><?php echo $row['animal']; ?></td>
                            	</tr>
                            </table>

                            <div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-center">Змінити логін</h5>
                            	<?php
                            		if(isset($_POST['update'])){
                            			$uname = $_POST['uname'];

                            			if(empty($uname)){

                            			} else{
                            				$query = "UPDATE animalowner SET username = '$uname' WHERE username='$animalowner'";

                            				$res = mysqli_query($connect,$query);

                            				if($res){
                            					$_SESSION['animalowner'] = $uname;
                            				}
                            			}
                            		}
                            	  ?>
                            <form method="post">
                            	<label>Введіть новий логін</label>
                            	<input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Введіть новий логін">
                            	<input type="submit" name="update" class="btn btn-info my-2" value="Змінити логін">
                            </form>

                            <h5 class="my-4 text-center">Змінити пароль</h5>
                            <?php
                                    if(isset($_POST['change_pass'])){
                                        $old = $_POST['old_pass'];
                                        $new = $_POST['new_pass'];
                                        $con = $_POST['con_pass'];

                                        $ol = "SELECT * FROM animalowner WHERE username = '$animalowner'";
                                        $ols = mysqli_query($connect, $ol);
                                        $row = mysqli_fetch_array($ols);

                                        if($old != $row['password']){
                                            echo "<p>Неправильний старий пароль</p>";
                                        } else if(empty($new)){
                                            echo "<p>Новий пароль не може бути порожнім</p>";
                                        } else if($con != $new){
                                            echo "<p>Паролі не збігаються</p>";
                                        } else{
                                            $query = "UPDATE animalowner SET password = '$new' WHERE username='$animalowner'";
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
                                        <input type="submit" name="change_pass" class="btn btn-info text-white mt-2" value="Змінити пароль">
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
