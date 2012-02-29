<?php
include 'init.php';

$total = 6;
$new = 0;
$installed = 0;

@mkdir("./{$config['storage']['db']}");
@mkdir("./{$config['storage']['db']}");

@mkdir("./{$config['pages']['folder']}");
@mkdir("./{$config['blog']['folder']}");
@mkdir("./{$config['templates']['folder']}");
@mkdir("./{$config['backups']['folder']}");

if(!file_exists("{$config['storage']['db']}/{$config['pages']['file']}")) {
	$csv = new parseCSV();
	$header = array('guid', 'title', 'description', 'keywords');
	$out = $csv->save("{$config['storage']['db']}/{$config['pages']['file']}", false, false, $header);
	$new++;
} else {
	$installed++;
}

if(!file_exists("{$config['storage']['db']}/{$config['blog']['file']}")) {
	$csv = new parseCSV();
	$header = array('guid', 'title', 'date');
	$out = $csv->save("{$config['storage']['db']}/{$config['blog']['file']}", false, false, $header);
	$new++;
} else {
	$installed++;
}

if(!file_exists("{$config['storage']['db']}/{$config['comments']['file']}")) {
	$csv = new parseCSV();
	$header = array('guid', 'blog_id', 'body', 'date', 'author', 'email');
	$out = $csv->save("{$config['storage']['db']}/{$config['comments']['file']}", false, false, $header);
	$new ++;
} else {
	$installed++;
}

if($new||$installed) {
	header('location:/cms/pages?installed=success');
} else {
	header('location:/cms/pages?installed=error');
}

exit();


?>