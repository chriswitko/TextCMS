<?php
require 'lib/sammy.php';

get('/', function() {
	header('location:/cms/pages');
	return "Hello.";
});

get('/cms', function() {
	header('location:/cms/pages');
	return;
});

// PAGES

get('/cms/pages', function($sammy) {
	include 'pages.php';
	return;
});

get('/cms/pages/new', function($sammy) {
	include 'pages.edit.php';
	return;
});

get('/cms/pages/edit', function($sammy) {
	include 'pages.edit.php';
	return;
});

get('/cms/pages/manage', function($sammy) {
	include 'controller.php';
	return;
});

post('/cms/pages', function($sammy) {
	include 'controller.php';
	return;
});

// BLOG

get('/cms/blog', function($sammy) {
	include 'blog.php';
	return;
});

get('/cms/blog/new', function($sammy) {
	include 'blog.edit.php';
	return;
});

get('/cms/blog/edit', function($sammy) {
	include 'blog.edit.php';
	return;
});

get('/cms/blog/manage', function($sammy) {
	include 'controller.php';
	return;
});

post('/cms/blog', function($sammy) {
	include 'controller.php';
	return;
});

post('/blog/comments', function($sammy) {
	include 'controller.php';
	return;
});

get('/blog/preview', function($sammy) {
	include 'blog.preview.php';
	return;
});

// TEMPLATES

get('/preview', function($sammy) {
	include 'preview.php';
	return;
});


// COMMENTS

get('/cms/comments', function($sammy) {
	include 'comments.php';
	return;
});

get('/cms/comments/manage', function($sammy) {
	include 'controller.php';
	return;
});

// GENERAL

get('/cms/install', function($sammy) {
	include 'install.php';
	return;
});

get('/cms/backup', function($sammy) {
	include 'backup.php';
	return;
});

get('/cms/signin', function($sammy) {
	include 'signin.php';
	return;
});

post('/cms/signin', function($sammy) {
	include 'signin.php';
	return;
});

get('/cms/logout', function($sammy) {
	include 'logout.php';
	return;
});

$sammy->run();
?>