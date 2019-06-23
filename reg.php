<?php
require('connect.php');
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo json_encode(array('success' => 0));
    } else {
        echo json_encode(array('success' => 1));
    }
}
?>
