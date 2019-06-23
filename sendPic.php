<?php
session_start();
$data = array();

if( isset( $_GET['uploadfiles'] ) ){
    $error = false;

    $uploaddir = './uploads/';


    if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );

    foreach( $_FILES as $file ){
        if( move_uploaded_file( $file['tmp_name'], $uploaddir . $_SESSION['user_id'] . ".png" ) ){
            $files =  $uploaddir . $_SESSION['user_id'] . ".png";
        }
        else{
            $error = true;
        }
    }
    $user_id = $_SESSION['user_id'];

    require('connect.php');
    $query = "UPDATE users SET image_dir='$files' WHERE id='$user_id'";
    $result = mysqli_query($connection, $query);

    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files);

    echo json_encode( $data );
    session_destroy();
}
?>
