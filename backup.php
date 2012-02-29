<?php
include 'init.php';

$filename_storage = "./{$config['backups']['folder']}/storage_".date("m-d-Y").".zip";

$filename_db = "./{$config['backups']['folder']}/db_".date("m-d-Y").".zip";

$cmd = "zip -r {$filename_storage} ./_storage";
exec($cmd);

$cmd = "zip -r {$filename_db} ./_db";
exec($cmd);

header('location:/cms/pages?backup=success');

exit();


?>