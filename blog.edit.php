<?php
$restricted_area = true;
include 'init.php';

$csv = new parseCSV();
$csv->auto("{$config['storage']['db']}/{$config['blog']['file']}");

$data = array();

if(@$_REQUEST['id']!='') {
	$data = $csv->data[@$_REQUEST['id']];
	$guid = $data['guid'];
	$file = "{$config['storage']['folder']}/{$config['blog']['folder']}/{$data['guid']}.html";
} else {
	$guid = uniqid();
}



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
			<p>
				<a class="" href="/cms/blog">&larr; powrót do listy</a>
			</p>

			<form class="form-vertical" method="post" action="/cms/blog">
				<input type="hidden" name="module" value="blog"/>
				<input type="hidden" name="action" value="save"/>
				<input type="hidden" name="f[guid]" value="<?php echo $guid; ?>"/>
				<input type="hidden" name="f[date]" value="<?php echo date("d-m-Y"); ?>"/>
				<input type="hidden" name="id" value="<?php echo @$_REQUEST['id']; ?>"/>
				<fieldset>
					<legend><?php echo @$_REQUEST['id']!=''?'Edycja wpisu':'Nowy wpis'; ?></legend>
					<div class="control-group">
						<label class="control-label" for="title">Tytuł wpisu</label>
						<div class="controls">
							<input type="text" class="input-xxlarge" id="title" name="f[title]" value="<?php echo @$data['title']; ?>"/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="body">Treść</label>
						<div class="controls">
							<textarea class="span12" id="body" name="body" rows="30" style="height:300px;"><?php echo $file?file_get_contents($file):''; ?></textarea>
						</div>
					</div>
					<div class="form-actions form-actions-clean">
						<button type="submit" class="btn btn-success">Zapisz zmiany</button>
						<a class="btn" href="/cms/blog">Anuluj</a>
					</div>
				</fieldset>
			</form>
		</div>
		<?php include 'inc.html.footer.php'; ?>
    </div>
    
	<!-- IMPORTANT -->

	<?php include 'inc.footer.php'; ?>
	
	<script type="text/javascript">
	//<![CDATA[
		$(document).ready(function() {
			CKEDITOR.replace( 'body' );
		});
	//]]>
	</script>
	
</body>
</html>