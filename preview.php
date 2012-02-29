<?php
include 'init.php';

class adPage {
    public $title;
    public $body;
    public $description;
    public $keywords;
}

if($_REQUEST['module']=='page') {
	$csv = new parseCSV();
	$csv->auto("{$config['storage']['db']}/{$config['pages']['file']}");

	$data = array();

	$data = $csv->data[@$_REQUEST['id']];
	$file = "{$config['storage']['folder']}/{$config['pages']['folder']}/{$data['guid']}.html";
	
	$template = file_get_contents("{$config['storage']['folder']}/{$config['templates']['folder']}/{$_REQUEST['template']}.html");
	
	$adPage = new adPage;
	$adPage->title = $data['title'];
	$adPage->body = file_get_contents($file );
	$adPage->description = $data['description'];
	$adPage->keywords = $data['keywords'];
	
	$m = new Mustache;
	echo $m->render($template, $adPage);
}

?>