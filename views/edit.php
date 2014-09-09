<html>
	<head>
	<meta charset="utf-8">
	</head>
	<body>
		<h1>Мой блог</h1>
		<h2>Добавить статью</h2>
		<form method="post" action="/index.php/blog/edit/<?php echo $article->id; ?>">
			<input type="text" name="title" value="<?php echo $article->title; ?>"> 
			<label>title</label></br>
			<textarea name="body"><?php echo $article->body; ?></textarea><label>text</label></br>
			<input type="submit">
		</form>
	</body>
</html>