<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Адміністратор</title>
</head>
<body>
<?php
include("../include/header.php");
?>

<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php  
                    include("sidenav.php");
                    include("../include/connection.php");
                ?>
            </div>
            <div class="col-md-10">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-center">Всі адміністратори</h5>

                            <?php
                                $ad = $_SESSION['admin'];
                                $query = "SELECT * FROM admin WHERE username != '$ad'";
                                $res = mysqli_query($connect, $query);

                                $output = "<table class='table table-bordered'>
                                            <tr>
                                                <th>ID</th>
                                                <th>Користувач</th>
                                                <th style='width: 10%'></th>
                                            </tr>";

                                if (mysqli_num_rows($res) < 1) {
                                    $output .= "<tr><td colspan='3' class='text-center'>No new admin</td></tr>";
                                } else {
                                    while ($row = mysqli_fetch_array($res)) {
                                        $id = $row['id'];
                                        $username = $row['username'];
                                        $output .= "
                                            <tr>
                                                <td>$id</td>
                                                <td>$username</td>
                                                <td>
                                                    <a href='admin?id=$id'><button id='$id' class='btn btn-danger'>Видалити</button></a>
                                                </td>
                                            </tr>";
                                    }
                                }

                                $output .= "</table>";

                                echo $output;

                                if(isset($_GET['id'])){
                                	$id=$_GET['id'];

                                	$query = "DELETE FROM admin WHERE id='$id'";

                                	mysqli_query($connect, $query);
                                }
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                                if (isset($_POST['add'])) {
                                    $uname = $_POST['uname'];
                                    $pass = $_POST['pass'];
                                    $image = $_FILES['img']['name'];

                                    $error = array();

                                    if (empty($uname)) {
                                        $error['u'] = "Enter admin username";
                                    } else if (empty($pass)) {
                                        $error['u'] = "Enter admin password";
                                    } else if (empty($image)) {
                                        $error['u'] = "Add admin image";
                                    }

                                    if (count($error) == 0) {
                                        $q = "INSERT INTO admin(username, password, profile) VALUES('$uname', '$pass', '$image')";

                                        $result = mysqli_query($connect, $q);

                                        if ($result) {
                                            move_uploaded_file($_FILES['img']['tmp_name'], "img/$image");
                                            echo "<script>alert('Admin added successfully')</script>";
                                        } else {
                                            echo "<script>alert('Failed to add admin')</script>";
                                        }
                                    } else {
                                        foreach ($error as $err) {
                                            echo "<p class='text-danger'>$err</p>";
                                        }
                                    }
                                }

                                if(isset($error['u'])){
                                	$er=$error['u'];
                                	$show="<h5 class='text-center alert alert-danger'>$er</h5>";
                                } else{
                                	$show="";
                                }
                            ?>
                            <h5 class="text-center">Додати адміністратора</h5>
                            <form method="post" enctype="multipart/form-data">
                            	<div>
                            		<?php
                            		echo $show;
                            		?>
                            	</div>
                                <div class="form-group">
                                    <label>ПІБ</label>
                                    <input type="text" name="uname" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Пароль</label>
                                    <input type="password" name="pass" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Фотографія</label>
                                    <input type="file" name="img" class="form-control">
                                </div>
                                <input type="submit" name="add" value="Зареєструвати" class="btn btn-success" style="margin-top: 15px">
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
