<html>
	<head>
	</head>
	<body>
		<h1>Мои статьи</h1>
		<button><a href="/index.php/blog/add">Добавить новую статью</a></button>

		<table style="border:3px solid violet; margin-top:20px;">
		
		<thead>
				<tr>
				<td style="border:1px solid lime;">id</td>
				<td style="border:1px solid lime;">title</td>
				</tr>
			</thead>
		<?php 
		foreach($article as $key):?>
		<tbody>
			<tr>
				<td style="border:1px solid lime;"><?php echo $key->id; ?></td>
				<td style="border:1px solid lime;"><?php echo $key->title; ?></td>
				<td style="border:1px solid lime;"><a href="/index.php/blog/view/<?php echo $key->slug; ?>"><input type="button" value="Посмотреть"></a></td>
				<td style="border:1px solid lime;"><a href="/index.php/blog/edit/<?php echo $key->id; ?>"><input type="button" value="Изменить"></a></td>
				<td style="border:1px solid lime;"><a href="/index.php/blog/remove/<?php echo $key->id; ?>"><input type="button" value="Удалить"></a></td>
			</tr>
			</tbody>
			<?php endforeach;?>
		</table>

	<?php	$article= Articles::all(); ?>

	</body>
</html>