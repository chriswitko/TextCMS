<?php
$restricted_area = true;
include 'init.php';

$csv = new parseCSV();
$csv->auto("{$config['storage']['db']}/{$config['pages']['file']}");

$data = array();

if(@$_REQUEST['id']!='') {
	$data = $csv->data[@$_REQUEST['id']];
	$guid = $data['guid'];
	$file = "{$config['storage']['folder']}/{$config['pages']['folder']}/{$data['guid']}.html";
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
				<a class="" href="/cms/pages">&larr; powrót do listy</a>
			</p>

			<form class="form-vertical" method="post" action="/cms/pages">
				<input type="hidden" name="module" value="page"/>
				<input type="hidden" name="action" value="save"/>
				<input type="hidden" name="f[guid]" value="<?php echo $guid; ?>"/>
				<input type="hidden" name="id" value="<?php echo @$_REQUEST['id']; ?>"/>
				<fieldset>
					<legend><?php echo @$_REQUEST['id']!=''?'Edycja strony':'Nowa strona'; ?></legend>
					<div class="control-group">
						<label class="control-label" for="title">Tytuł strony</label>
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
					<div class="control-group">
						<label class="control-label" for="description">Opis <span class="label label-info">meta=description</span></label>
						<div class="controls">
							<input type="text" class="input-xxlarge" id="description" name="f[description]" manlength="180" value="<?php echo @$data['description']; ?>">
							<p class="help-block">Maksymalnie 180 znaków</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="keywords">Słowa kluczowe <span class="label label-info">meta=keywords</span></label>
						<div class="controls">
							<input type="text" class="input-xxlarge" id="keywords" name="f[keywords]" value="<?php echo @$data['keywords']; ?>">
							<p class="help-block">np.: strona, blog, produkt</p>
						</div>
					</div>
					<div class="form-actions form-actions-clean">
						<button type="submit" class="btn btn-success">Zapisz zmiany</button>
						<a class="btn" href="/cms/pages">Anuluj</a>
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