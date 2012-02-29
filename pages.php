<?php
$restricted_area = true;
include 'init.php';

$csv = new parseCSV();
$csv->auto("{$config['storage']['db']}/{$config['pages']['file']}");

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
				<h1>Strony <small>Liczba stron: <?php echo count($csv->data); ?></small></h1>
			</div>
			<?php if(@$_REQUEST['status']) {?>
				<div class="alert alert-<?php echo $_REQUEST['status']; ?>">
					<?php echo $_REQUEST['status']=='success'?'Zmiany zostały zapisane.':'Wystąpił błąd podczas zapisywania zmian.'; ?>
				</div>
			<?php } ?>
			<?php if(@$_REQUEST['installed']) {?>
				<div class="alert alert-<?php echo $_REQUEST['installed']; ?>">
					<?php echo $_REQUEST['installed']=='success'?'Struktura plików została utworzona.':'Wystąpił błąd podczas instalcji aplikacji.'; ?>
				</div>
			<?php } ?>
			<?php if(@$_REQUEST['backup']) {?>
				<div class="alert alert-<?php echo $_REQUEST['backup']; ?>">
					<?php echo $_REQUEST['installed']=='success'?'Kopia zapasowa została utworzona.':'Wystąpił błąd podczas tworzenia kopii zapasowej.'; ?>
				</div>
			<?php } ?>
			<p>
				<a class="btn btn-success" href="/cms/pages/new"><i class="icon-plus icon-white"></i> Nowa strona</a>
			</p>
			<?php if(@$csv->data) {?>
			<table width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Tytuł strony</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($csv->data as $key => $row): ?>
					<tr>
						<td width="100%">
							<a href="/cms/pages/edit?id=<?php echo $key; ?>"><?php echo $row['title']; ?></a>
							<br/><small style="font-size:10px;">Szablon: <a target="_blank" href="/preview?template=default&amp;module=page&amp;id=<?php echo $key; ?>">Default</a></small>
						</td>
						<td nowrap="nowrap"><a class="btn btn-mini btn-success" href="/cms/pages/edit?id=<?php echo $key; ?>">Edytuj</a>&nbsp;&nbsp;<a class="btn btn-mini" href="/cms/pages/manage?module=page&amp;action=delete&amp;id=<?php echo $key; ?>" onclick="if(!confirm('Czy napewno chcesz usunąć wybrany rekord?')) return false; ">Usuń</a></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			<?php } else { ?>
				<p>Brak nowych stron.</p>
			<?php } ?>
		</div>
		<?php include 'inc.html.footer.php'; ?>
    </div>
    
	<!-- IMPORTANT -->

	<?php include 'inc.footer.php'; ?>
</body>
</html>

