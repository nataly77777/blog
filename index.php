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
	return render("home", array(
		
	));
});

$app->get('/blog/add', function(){
$article=new Articles;

$article->title=$_GET["title"];
$article->body=$_GET["body"];
$article->slug=$_GET["slug"];
$article->user_id=$_GET["user_id"];

$article->save();

return render("add");
});

$app->get('/blog/edit/{id}', function($id){
	return 'Hello World!';
});

$app->get('/blog/remove/{id}', function($id){
	return 'Hello World!';
});

	
$app->get('/blog/view{slug}', function($slug){
	return 'Hello World!';
});
$app->run();  
?>

