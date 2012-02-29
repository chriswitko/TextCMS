<?php
include 'init.php';

if(@$_REQUEST['action']=='login') {
	if($_REQUEST['username']==$config['root']['username']&&$_REQUEST['password']==$config['root']['password']) {
		$_SESSION['user_id'] = $_REQUEST['username'];
		header('location:/cms/pages');
	} else {
		header('location:/cms/signin?status=error');
	}
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
			<div class="page-header">
				<h1>Logowanie <small><?php echo $config['app']['title']; ?></small></h1>
			</div>
			<?php if(@$_REQUEST['status']) {?>
				<div class="alert alert-<?php echo $_REQUEST['status']; ?>">
					<?php echo $_REQUEST['status']=='success'?'':'Wystąpił błąd podczas logowania.'; ?>
				</div>
			<?php } ?>
			<form class="form-horizontal" method="post" action="/cms/signin">
				<input type="hidden" name="action" value="login"/>
				<fieldset>
					<div class="control-group">
						<label class="control-label" for="username">Nazwa użytkownika</label>
						<div class="controls">
							<input type="text" class="span5" id="username" name="username" value=""/>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password">Hasło</label>
						<div class="controls">
							<input type="password" class="span5" id="password" name="password" value=""/>
						</div>
					</div>
					<div class="form-actions form-actions-clean">
						<button type="submit" class="btn btn-success">Dalej &raquo;</button>
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