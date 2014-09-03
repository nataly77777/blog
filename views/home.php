<html>
	<head>
	</head>
	<body>
		<h1>Мои статьи</h1>
		<button><a href="/index.php/blog/add">Добавить новую статью</a></button>
		<table style="border:3px solid violet;">
		<?php 
		$article = Articles::get();
		foreach($article as $key){?>
			<tr>
				<td style="border:1px solid lime;"><?php echo $key->title; ?></td>
				<td style="border:1px solid lime;"><a href="/index.php/blog/edit/<?php echo $key->id; ?>"><input type="button" value="Изменить"></a></td>
				<td style="border:1px solid lime;"><a href="#"><input type="button" value="Удалить"></a></td>
			</tr>
			<?php };?>
		</table>

	<?php	$article= Articles::all(); ?>

	</body>
</html>