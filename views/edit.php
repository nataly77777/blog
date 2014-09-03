<html>
	<head>
	<meta charset="utf-8">
	</head>
	<body>
		<h1>Мой блог</h1>
		<h2>Добавить статью</h2>
		<form method="post" action="/index.php/blog/add">
			<input type="text" name="title"> 
			<label>title</label></br>
			<textarea name="body"></textarea><label>text</label></br>
			<input type="slug" name="slug" ><label>slug</label></br>
			<input type="submit">
		</form>
	</body>
</html>