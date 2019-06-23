<?php
ini_set('session.save_handler', 'memcache');
ini_set('session.save_path', 'tcp://127.0.0.1:11211?persistent=1&weight=1&timeout=1&retry_interval=15');
ini_set('session.use_strict_mode', 1);
session_start();
session_regenerate_id();
$_SESSION['id'] = session_id();
?>