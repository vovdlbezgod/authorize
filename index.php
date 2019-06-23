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
<?php
require('connect.php');

if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if($_POST['password'] == $_POST['repeat_password']) {
        $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $smsq = "Регистрация прошла успешно";
        } else {
            $fsmsg = "Пользователь уже существует";
        }
    }else{
        $fsmsg = "Пароли не совпадают";
    }
}
?>
    <div class="container">
        <form class="form-signin" method="post">
            <h2>Регистрация</h2>
            <?php if(isset($smsq)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsq; ?> </div><?php }?>
            <?php if(isset($fsmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fsmsg; ?> </div><?php }?>

            <input type="text" name="email" class="form-control" placeholder="E-mail" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <input type="password" name="repeat_password" class="form-control" placeholder="Repeat Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
            <a href="login.php" class="btn btn-lg btn-primary btn-block">Вход</a>
        </form>
    </div>
</body>
</html>
