<?php
include 'init.php';

session_regenerate_id();

$_SESSION['user_id'] = '';

header('location:/cms/signin');
exit();

?>