<?php
session_start();
require('connect.php');
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    $result = mysqli_query($connection, $query);
    //$query = "SELECT id FROM users WHERE email = '$email'";
    if ($result) {
        $_SESSION['user_id'] = mysqli_insert_id($connection);
        echo json_encode(array('success' => 0, 'id' => mysqli_insert_id($connection)));
    } else {
        echo json_encode(array('success' => 1));
    }
}
?>
