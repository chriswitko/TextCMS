<?php
$restricted_area = true;
include 'init.php';

$csv = new parseCSV();
$csv->sort_reverse = true;
$csv->sort_by = 'id';
$csv->auto("{$config['storage']['db']}/{$config['comments']['file']}");

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
				<h1>Komentarze <small>Liczba komentarzy: <?php echo count($csv->data); ?></small></h1>
			</div>
			<?php if(@$_REQUEST['status']) {?>
				<div class="alert alert-<?php echo $_REQUEST['status']; ?>">
					<?php echo $_REQUEST['status']=='success'?'Zmiany zostały zapisane.':'Wystąpił błąd podczas zapisywania zmian.'; ?>
				</div>
			<?php } ?>
			<?php if(@$csv->data) {?>
			<table width="100%" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Fragment komentarza</th>
						<th>Data</th>
						<th>Wpis</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($csv->data as $key => $row): ?>
					<tr>
						<td width="100%"><?php echo $row['body']; ?></td>
						<td nowrap="nowrap"><?php echo $row['date']; ?></td>
						<td nowrap="nowrap"><a href="/blog/preview?id=<?php echo $row['blog_id']; ?>">Zobacz</a></td>
						<td nowrap="nowrap"><a class="btn btn-mini" href="/cms/comments/manage?module=comments&amp;action=delete&amp;id=<?php echo $key; ?>" onclick="if(!confirm('Czy napewno chcesz usunąć wybrany rekord?')) return false; ">Usuń</a></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			<?php } else { ?>
				<p>Brak nowych komentarzy.</p>
			<?php } ?>
		</div>
		<?php include 'inc.html.footer.php'; ?>
    </div>
    
	<!-- IMPORTANT -->

	<?php include 'inc.footer.php'; ?>
</body>
</html>

