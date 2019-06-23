<?php
ini_set('session.save_handler', 'memcache');
ini_set('session.save_path', 'tcp://localhost:11211');
ini_set('session.use_strict_mode', 1);
session_start();
session_regenerate_id();
$_SESSION['id'] = session_id();
require('connect.php');
if(isset($_POST['email']) and isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' and password='$password' LIMIT 1";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    $obj = mysqli_fetch_object($result);

    if($count == 1){
        $_SESSION['email'] = $obj->email;
        $_SESSION['image_dir'] = $obj->image_dir;
    }else{
        echo json_encode(array('success' => 1));
    }
}
mysqli_close($connection);
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $image_dir = $_SESSION['image_dir'];
    $session_id = $_SESSION['id'];
    echo json_encode(array('success' => 0, 'email' => $email, 'image_dir'=> $image_dir, 'session_id'=> $session_id));
}
?>