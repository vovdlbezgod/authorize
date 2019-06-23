<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta names="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <form class="form-signin" method="post">
        <h2>Логин</h2>
        <input type="text" name="email" class="form-control" placeholder="E-mail" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
        <a href="index.php" class="btn btn-lg btn-primary btn-block">Регистрация</a>
    </form>
</div>
<?php
require('connect.php');
if(isset($_POST['email']) and isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' and password='$password'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);

    if($count == 1){
        $_SESSION['email'] = $email;
    }else{
        $fsmsg = "Ошибка";
    }
}
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    echo "Привет, ", $email, ", ";
    echo "Вы вошли";
    echo "<a href='logout.php' class='btn btn-lg btn-primary btn-block'>Выйти</a>";
}
?>
</body>
</html>
