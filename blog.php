<?php
$restricted_area = true;
include 'init.php';

$csv = new parseCSV();
$csv->sort_reverse = true;
$csv->sort_by = 'id';
$csv->auto("{$config['storage']['db']}/{$config['blog']['file']}");

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
				<h1>Blog <small>Liczba wpisów: <?php echo count($csv->data); ?></small></h1>
			</div>
			<?php if(@$_REQUEST['status']) {?>
				<div class="alert alert-<?php echo $_REQUEST['status']; ?>">
					<?php echo $_REQUEST['status']=='success'?'Zmiany zostały zapisane.':'Wystąpił błąd podczas zapisywania zmian.'; ?>
				</div>
			<?php } ?>
			<p>
				<a class="btn btn-success" href="/cms/blog/new"><i class="icon-plus icon-white"></i> Nowy wpis</a>
			</p>
			<?php if(@$csv->data) {?>
			<table width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Tytuł strony</th>
						<th>Data</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($csv->data as $key => $row): ?>
					<tr>
						<td width="100%"><a href="/cms/blog/edit?id=<?php echo $key; ?>"><?php echo $row['title']; ?></a></td>
						<td nowrap="nowrap"><?php echo $row['date']; ?></td>
						<td nowrap="nowrap"><a class="btn btn-mini btn-success" href="/cms/blog/edit?id=<?php echo $key; ?>">Edytuj</a>&nbsp;&nbsp;<a class="btn btn-mini btn-success" href="/blog/preview?id=<?php echo $key; ?>">Podgląd</a>&nbsp;&nbsp;<a class="btn btn-mini" href="/cms/blog/manage?module=blog&amp;action=delete&amp;id=<?php echo $key; ?>" onclick="if(!confirm('Czy napewno chcesz usunąć wybrany rekord?')) return false; ">Usuń</a></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			<?php } else { ?>
				<p>Brak nowych wpisów.</p>
			<?php } ?>
		</div>
		<?php include 'inc.html.footer.php'; ?>
    </div>
    
	<!-- IMPORTANT -->

	<?php include 'inc.footer.php'; ?>
</body>
</html>

