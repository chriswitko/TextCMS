<?php
include 'init.php';

if($_REQUEST['module']=='page') {
	if($_REQUEST['action']=='save') {
		$csv = new parseCSV();

		$data['guid'] = @$_REQUEST['f']['guid'];
		$data['title'] = @$_REQUEST['f']['title'];
		$data['description'] = @$_REQUEST['f']['description'];
		$data['keywords'] = @$_REQUEST['f']['keywords'];
		
		if($_REQUEST['id']!='') {
			// UPDATE
			$csv = new parseCSV();
			$csv->parse("{$config['storage']['db']}/{$config['pages']['file']}");
			$csv->data[$_REQUEST['id']] = $data;
			$out = $csv->save("{$config['storage']['db']}/{$config['pages']['file']}");
		} else {
			// INSERT
			$out = $csv->save("{$config['storage']['db']}/{$config['pages']['file']}", array($data), true, array($header));
		}
		
		$dataFile = "{$config['storage']['folder']}/{$config['pages']['folder']}/{$data['guid']}.html";
		$fh = fopen($dataFile, 'w');
		fwrite($fh, @$_REQUEST['body']);
		fclose($fh);
		
		if($out) {
			header('location:/cms/pages?status=success');
		} else {
			header('location:/cms/pages?status=error');
		}
	}
	
	if($_REQUEST['action']=='delete') {
		removeFromCSV("{$config['storage']['db']}/{$config['pages']['file']}", $_REQUEST['id']);
		header('location:/cms/pages?status=success');
	}
}

if($_REQUEST['module']=='blog') {
	if($_REQUEST['action']=='save') {
		$csv = new parseCSV();

		$data['guid'] = @$_REQUEST['f']['guid'];
		$data['title'] = @$_REQUEST['f']['title'];
		$data['date'] = @$_REQUEST['f']['date'];
		
		if($_REQUEST['id']!='') {
			// UPDATE
			$csv = new parseCSV();
			$csv->parse("{$config['storage']['db']}/{$config['blog']['file']}");
			$csv->data[$_REQUEST['id']] = $data;
			$out = $csv->save("{$config['storage']['db']}/{$config['blog']['file']}");
		} else {
			// INSERT
			$out = $csv->save("{$config['storage']['db']}/{$config['blog']['file']}", array($data), true, array($header));
		}
		
		$dataFile = "{$config['storage']['folder']}/{$config['blog']['folder']}/{$data['guid']}.html";
		$fh = fopen($dataFile, 'w');
		fwrite($fh, @$_REQUEST['body']);
		fclose($fh);
		
		if($out) {
			header('location:/cms/blog?status=success');
		} else {
			header('location:/cms/blog?status=error');
		}
	}
	
	if($_REQUEST['action']=='delete') {
		removeFromCSV("{$config['storage']['db']}/{$config['blog']['file']}", $_REQUEST['id']);
		
		$comments = new parseCSV();
		$comments->sort_reverse = true;
		$comments->sort_by = 'id';
		$comments->conditions = "blog_id is {$_REQUEST['id']}";
		$comments->auto("{$config['storage']['db']}/{$config['comments']['file']}");

		if(@$comments->data) {
			foreach ($comments->data as $key => $row) {
				removeFromCSVByGuid("{$config['storage']['db']}/{$config['comments']['file']}", $row['guid']);
			}
		}
		
		header('location:/cms/blog?status=success');
	}
}

if($_REQUEST['module']=='comments') {
	if($_REQUEST['action']=='save') {
		$csv = new parseCSV();

		// $header = array('id', 'blog_id', 'body', 'date', 'author', 'email');

		$data['guid'] = @$_REQUEST['f']['guid'];
		$data['blog_id'] = @$_REQUEST['f']['blog_id'];
		$data['body'] = @$_REQUEST['f']['body'];
		$data['date'] = @$_REQUEST['f']['date'];
		$data['author'] = @$_REQUEST['f']['author'];
		$data['email'] = @$_REQUEST['f']['email'];
		
		if($_REQUEST['id']!='') {
			// UPDATE
			$csv = new parseCSV();
			$csv->parse("{$config['storage']['db']}/{$config['comments']['file']}");
			$csv->data[$_REQUEST['id']] = $data;
			$out = $csv->save("{$config['storage']['db']}/{$config['comments']['file']}");
		} else {
			// INSERT
			$out = $csv->save("{$config['storage']['db']}/{$config['comments']['file']}", array($data), true, array($header));
		}
		
		if($out) {
			header("location:/blog/preview?id={$data['blog_id']}&status=success");
		} else {
			header("location:/blog/preview?id={$data['blog_id']}&status=error");
		}
	}
	
	if($_REQUEST['action']=='delete') {
		removeFromCSV("{$config['storage']['db']}/{$config['comments']['file']}", $_REQUEST['id']);
		header('location:/cms/comments?status=success');
	}
}

function removeFromCSV($fileName, $lineNum) {
	$lineNum++;

	if(!is_writable($fileName)) {
		exit;
	} else {
		$arr = file($fileName);
	}

	$lineToDelete = $lineNum;//-1

	if($lineToDelete > sizeof($arr)) {
	    // print "You have chosen a line number, <b>[$lineNum]</b>,  higher than the length  of the file.";
		exit;
	}

	//remove the line
	unset($arr["$lineToDelete"]);

	// open the file for reading
	if (!$fp = fopen($fileName, 'w+')) {
		// print "Cannot open file ($fileName)";
		exit;
	}

	if($fp) {
		// write the array to the file
		foreach($arr as $line) { fwrite($fp,$line); }
	    fclose($fp);
	}
	
}

function removeFromCSVByGuid($fileName, $guid) {
	$counter = 0;
	
	if(!is_writable($fileName)) {
		exit;
	} else {
		$arr = file($fileName);
	}
	
	foreach($arr as $line) {
		if(strpos($line, $guid)>-1) {
			$lineNum = $counter;
			break;
		}
		$counter++;
	}

	$lineToDelete = $lineNum;//-1

	if($lineToDelete > sizeof($arr)) {
	    // print "You have chosen a line number, <b>[$lineNum]</b>,  higher than the length  of the file.";
		exit;
	}

	//remove the line
	unset($arr["$lineToDelete"]);

	// open the file for reading
	if (!$fp = fopen($fileName, 'w+')) {
		// print "Cannot open file ($fileName)";
		exit;
	}

	if($fp) {
		// write the array to the file
		foreach($arr as $line) { fwrite($fp,$line); }
	    fclose($fp);
	}
	
}

exit();

?>