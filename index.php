<?php

require_once __DIR__.'/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'blog',
    'username'  => 'root',
    'password'  => '111',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

function render($view, $params=array()){
	ob_start();
	extract($params); // разбирает массив на переменные - ключи становятся именами переменных, а значения ключей - значениями переменных
	include "views/".$view.".php";
	$view=ob_get_contents();
	ob_end_clean();
	return $view;
}

$app=new Silex\Application();
$app['debug'] = true;

$app->get('/', function(){

// $article = Articles::get();

	return render("home");
});

$app->get('/blog/add', function(){
	return render("add");
});
$app->post('/blog/add', function() use ($app){

$article=new Articles;

$article->title=$_POST["title"];
$article->body=$_POST["body"];
$article->slug=$_POST["slug"];
$article ->user_id=125;
$article->save();

return $app->redirect('/');
});

$app->get('/blog/edit/{id}', function($id){
	$article= Articles::find($id);
	echo $article->title;

	return render("edit");

});
$app->post('/blog/edit/{id}', function($id){
	$article->title=$_POST["title"];
	$article->body=$_POST["body"];
	$article->slug=$_POST["slug"];

	$article->save();
});

$app->get('/blog/remove/{id}', function($id){
	$article = Articles::find($id);
	$article->delete();
	return render("home");
});

	
$app->get('/blog/view{slug}', function($slug){
	return 'Hello World!';
});
$app->run();  
?>

<!-- SELECT * FROM users Where name='John' LIMIT 1 ORDER BY name,id DESC -->
<!-- SELECT COUNT( id)  FROM comments;

SELECT * ,(SELECT COUNT(id) FROM comments WHERE comments.article_id=articles.id)
 AS comcount
FROM articles ; 
SELECT * FROM articles WHERE body LIKE '%ipsun%';
 -->