<?php

Core::$CSS = '/css/w_teh.css';

if(isset($_GET['id'])) {
$tovar1 = q("
	SELECT *
	FROM `tovar`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
	") ;
	if(mysqli_num_rows($tovar1)) { // если есть записи
		$res = $tovar1->fetch_assoc();		
		Core::$META['title'] = $res['title'];
		Core::$META['description'] = $res['meta_description'];
		Core::$META['keywords'] = $res['meta_keywords'];
		$tovar = q("
	SELECT *
	FROM `tovar`
	WHERE `id` = ".(int)$_GET['id']."
	LIMIT 1
	") ;
	}else {
		$_SESSION['info'] = 'Товара не существует' ;
	}
} else {
	$_SESSION['info'] = 'Товара не существует' ;
}
$tovar1->close();

if(isset($_SESSION['info'])) {
	$info= $_SESSION['info'];
	unset($_SESSION['info']);
}
	/*
	$res = mysqli_fetch_assoc($tovar);
	$tovar->close();
	
	$count = preg_match_all('#([/\w\d_-]*.{2,5});#ui',  $res['dop_img'], $matches); // matches - найденные совпадения в виде массива

echo 'count =  '.$count;
echo '<br><b>preg_match_all()'.$row['dop_img'].'</b><br><hr>';
$count = preg_match_all('#([/\w\d_-]*.{2,5});#ui',  $row['dop_img'], $matches); // matches - найденные совпадения в виде массива

echo '<pre>'.print_r($matches,1).'</pre> <br><hr>';

echo '<br>'.$matches[1][0];
echo '<br>'.($matches[1][1]);
echo '<br>'.($matches[1][2]);
echo '<br>'.($matches[1][3]);
	//if(!preg_match('#^/[a-z-_]*$#iu', $row['dop_img']))
	exit;

	//if(preg_match('#^[\wё\s]{3,18}$#ui',  $text, $matches) ) {
*/