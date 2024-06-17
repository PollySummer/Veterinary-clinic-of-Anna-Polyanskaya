<?php 
include("../include/connection.php");

$id = $_POST['id'];

$query = "UPDATE doctors SET status = 'Approved' WHERE id='$id'";

if (mysqli_query($connect, $query)) {
    echo "Success";
} else {
    echo "Error: " . mysqli_error($connect);
}
?>
