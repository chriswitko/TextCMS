<?php
session_start();

$time = microtime(TRUE);
$mem = memory_get_usage();

include 'config.php';
include 'lib/helper.php';
include 'lib/mustache.php';
include 'lib/parsecsv.lib.php';

$css_version = '1.9.54';
$js_version = '1.2.5';

$basefile = pathinfo($_SERVER['REQUEST_URI']);
$filename = @$basefile['filename'];

$post = $_REQUEST;

$is_signin = false;

if(@$_SESSION['user_id']) {
	$is_signin = true;
}

if(@$restricted_area && !$is_signin) {
	header('location:/cms/signin');
	exit();
}

?>