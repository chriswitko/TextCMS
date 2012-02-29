<?php
error_reporting(0);

// GENERAL

$salt = 'chrislovesyou';

$config['app']['title'] = 'adPilot CMS';

// ADMIN

$config['root']['username'] = 'adpilot';
$config['root']['password'] = 'demo';

// DB & FOLDERS

$config['storage']['folder'] = '_storage';
$config['storage']['db'] = '_db';

$config['pages']['folder'] = '_pages';
$config['pages']['file'] = 'db.pages.csv';

$config['blog']['folder'] = '_blog';
$config['blog']['file'] = 'db.blog.csv';

$config['comments']['file'] = 'db.comments.csv';

$config['templates']['folder'] = '_templates';

$config['backups']['folder'] = '_backups';

?>
