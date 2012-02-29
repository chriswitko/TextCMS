<?php
include 'init.php';

$csv = new parseCSV();
$csv->auto("{$config['storage']['db']}/{$config['blog']['file']}");

$data = array();

if(@$_REQUEST['id']!='') {
	$data = $csv->data[@$_REQUEST['id']];
	$guid = uniqid();
	$file = "{$config['storage']['folder']}/{$config['blog']['folder']}/{$data['guid']}.html";
}

$comments = new parseCSV();
$comments->sort_reverse = true;
$comments->sort_by = 'id';
$comments->conditions = "blog_id is {$_REQUEST['id']}";
$comments->auto("{$config['storage']['db']}/{$config['comments']['file']}");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'inc.head.php'; ?>
</head>

<body id="landing" class="has-sidebar">
	<?php include 'inc.topbar.default.php'; ?>
	<div class="container">
		<div class="page">
			<form class="form-vertical" method="post" action="/blog/comments">
				<input type="hidden" name="module" value="comments"/>
				<input type="hidden" name="action" value="save"/>
				<input type="hidden" name="f[blog_id]" value="<?php echo @$_REQUEST['id']; ?>"/>
				<input type="hidden" name="f[guid]" value="<?php echo $guid; ?>"/>
				<input type="hidden" name="f[date]" value="<?php echo date("d-m-Y"); ?>"/>
				<fieldset>
					<legend><?php echo @$data['title']; ?></legend>
					<p><br/></p>
					<?php echo $file?file_get_contents($file):''; ?>
				</fieldset>
				<fieldset>
					<legend>Komentarze</legend>
					<p><br/></p>
					
					<?php if(@$comments->data) {?>
						<?php foreach ($comments->data as $key => $row): ?>
							<blockquote>
								<p><?php echo $row['body']; ?></p>
								<small><?php echo $row['date']; ?> · dodał: <?php echo $row['author']; ?> <?php echo $row['email']?"(email: {$row['email']})":''; ?></small>
							</blockquote>
						<?php endforeach; ?>
					<?php } else { ?>
						<p>Brak nowych komentarzy.</p>
					<?php } ?>

					<div class="control-group">
						<label class="control-label" for="author">Imię</label>
						<div class="controls">
							<input type="text" class="span6" id="author" name="f[author]" value=""/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="email">E-mail</label>
						<div class="controls">
							<input type="text" class="span6" id="email" name="f[email]" value=""/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="body">Treść</label>
						<div class="controls">
							<textarea class="span6" id="body" name="f[body]" rows="10" style="height:100px;"></textarea>
						</div>
					</div>
					<div class="form-actions form-actions-clean">
						<button type="submit" class="btn btn-success">Zapisz komentarz</button>
					</div>
				</fieldset>
			</form>
		</div>
		<?php include 'inc.html.footer.php'; ?>
    </div>
    
	<!-- IMPORTANT -->

	<?php include 'inc.footer.php'; ?>
	
</body>
</html>