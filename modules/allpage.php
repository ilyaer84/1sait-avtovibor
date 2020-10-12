<?php 
// для всех страниц


// 26 less мета данные для конкретной страницы
/*
$res = q("
	SELECT *
	FROM `meta`
	WHERE '".es($_GET['module'])."_".es($_GET['page'])."'
	LIMIT 1
");
$row = mysqli_fetch_assoc($res);
Core::$META = $row;  // выбрали все из БД передали в row 
*/
/* или дубовый вариант
Core::$META = $row['title'];
Core::$META['description'] = $row['description'];
Core::$META['keywords'] = $row['keywords'];
*/

/*
$tovar_i = q("
	SELECT `img`
	FROM `tovar`
	") ;

	/*
	while ($row = mysqli_fetch_assoc($tovar_i)) { 
		$count = preg_match_all('#/([\w\d_-]*).{2,5}$#ui',  $row['img'], $matches);
		wtf($count,1);
		wtf($matches,1);
		echo '<br>'.$matches[1][0];
	}
	echo '<hr><pre>'.print_r($matches,1).'</pre> <br><hr>';
	*/
/*
	$tov_i = mysqli_fetch_assoc($tovar_i);
	$tovar_i->close();
	
	$count = preg_match_all('#([/\w\d_-]*.{2,5});#ui',  $tov_i['img'], $matches); // matches - найденные совпадения в виде массива

echo 'count =  '.$count;
echo '<br><b>preg_match_all() = '.$tov_i['img'].'</b><br><hr>';
$count = preg_match_all('#([/\w\d_-]*.{2,5});#ui',  $tov_i['img'], $matches); // matches - найденные совпадения в виде массива

while ($tov_i = mysqli_fetch_assoc($tovar_i)) { 
	$count = preg_match_all('#([/\w\d_-]*.{2,5});#ui',  $row['dop_img'], $matches);
}

echo '<pre>'.print_r($matches,1).'</pre> <br><hr>';

echo '<br>'.$matches[1][0];
echo '<br>'.($matches[1][1]);
echo '<br>'.($matches[1][2]);
echo '<br>'.($matches[1][3]);
	//if(!preg_match('#^/[a-z-_]*$#iu', $row['dop_img']))
	exit;

	//if(preg_match('#^[\wё\s]{3,18}$#ui',  $text, $matches) ) {

		*/
