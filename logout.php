<?php
session_start();
echo json_encode(array("success"=>0,"session_id"=>session_id(), "user_email"=>$_SESSION['email']));
session_destroy();
session_commit();
echo json_encode(array("success"=>1,"session_id"=>session_id(), "user_email"=>$_SESSION['email']));
//header('Location: http://localhost/authorize/index.html');
exit;