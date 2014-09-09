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

function slug($str, $delimiter='-') 
{
    $cyrylicFrom = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $cyrylicTo   = array('A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh', 'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd', 'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '', 'e', 'iu', 'ia'); 

    $clean = str_replace($cyrylicFrom, $cyrylicTo, $str); 
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = strtolower($clean);
    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

    return trim($clean, '-');
}


$app=new Silex\Application();
$app['debug'] = true;

$app->get('/', function(){

$article = Articles::all();
    return render("home", array(
        "article" => $article
    ));
});

$app->get('/blog/add', function(){
	return render("add");
});
$app->post('/blog/add', function() use ($app){

$article=new Articles;

$article->title=$_POST["title"];
$article->body=$_POST["body"];

$slug=slug($_POST["title"]);
$check_slug=Articles::where('slug', '=', '$slug')->first();

if($check_slug){
	$article->slug=$check_slug+1;
};

// $article->slug=slug($_POST["title"]);

$article->user_id=125;
$article->save();

return $app->redirect('/');
});

$app->get('/blog/view/{slug}', function($slug){
	$article=Articles::where("slug", "=", $slug)->gett();

	return render("view", array(
		"article"=>$article
		));
});

$app->get('/blog/edit/{id}', function($id){

	$article= Articles::find($id);

	return render("edit", array(
   "article" => $article
   ));

});

$app->post('/blog/edit/{id}', function($id){
	Capsule::table('articles')
            ->where('id', $id )
            ->update(array('title'=> $_POST["title"],
            	     'body' => $_POST["body"],
                     'slug' => $_POST["slug"]
            ));
   return render("home");
});

$app->get('/blog/remove/{id}', function($id){
	$article = Articles::find($id);
	$article->delete();
	return render("home");
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