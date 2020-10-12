<?php
Core::$META['title'] = 'Каталог Автотоваров';
Core::$META['description'] ="Автозвук, магнитола, магнитола на lada granta, автомагнитола 2 din, автомагнитола на лада веста, автомагнитола на ладу, колонки, авто усилители, электроника, авто аксессуары";



$cat = q(" 
SELECT *
FROM `cat`
");

if(isset($_GET['c'])) {
	$isset_cat = q(" 
	SELECT *
	FROM `cat`
	WherE `id` = ".(int)$_GET['c']."
	Limit 1
	");

	if(mysqli_num_rows($isset_cat)) { // если есть записи
		$cat_q = $isset_cat->fetch_assoc();
		Core::$META['title'] = $cat_q['cat'];
		Core::$META['description'] = $cat_q['title'];

	} else {
		$_SESSION['info'] = 'Категории не существует' ;
	}
	$isset_cat->close();
}

if(isset($_GET['id'])) {
	$isset_podcat = q(" 
	SELECT *
	FROM `podcat`
	WherE `id` = ".(int)$_GET['id']."
	Limit 1
	");

	if(!mysqli_num_rows($isset_podcat)) { // если есть записи
		$_SESSION['info'] = 'Подкатегории не существует' ;
	}
	$isset_podcat->close();
}


if(isset($_GET['c'])) {
$catq = q(" 
SELECT *
FROM `cat`
WHERE `id` = ".$_GET['c']."
Limit 1
");
$res3 = $catq->fetch_assoc();
$catq->close();
} else {
	$res3['title']= 'Автотовары';
}




	
//***  paginator пагинатор 

paginator::$countView = 3; // количество материалов на странице
paginator::$url = '/catalog'; // 

    

if(!isset($_GET['num'])) { // номер страницы
	paginator::$pageNum=1;	
} else {
	 paginator::$pageNum = $_GET['num'];
}		

$startIndex = (paginator::$pageNum-1)*(paginator::$countView); // с какой записи начать выборку
// запрос к бд

if(isset($_GET['c']) && !isset($_GET['action'])) { 
	//$id = (int)$_GET['c'];
	paginator::$url = "/catalog&c=".$_GET['c'];
	paginator::$url_q = "/catalog&c=".$_GET['c']; // 
	$qpodcat = q("
	SELECT * 
	FROM `podcat`
	WHERE `id_cat` = ".$_GET['c']." 
	Limit 1               
		");
		$array = [];

 while ($qpod = mysqli_fetch_assoc($qpodcat)) { 
	
	 $array[] = (int)$qpod['id'];
		}
		$qpodcat->close();
	  
			foreach($array as $k=>$v) {
				$array[$k] = (int)$v;
			}
$array = implode(',',$array);

$sql = q("
	SELECT * 
	FROM `tovar`
	WHERE `id_podcat` IN (".$array.") 
	ORDER BY `date` DESC
	LIMIT $startIndex, ".paginator::$countView."              
	");

	$sql2 = q(" 
	SELECT COUNT(*)
	FROM `tovar`
	WHERE `id_podcat` IN (".$array.")
	");
	
	$result2 = mysqli_fetch_assoc($sql2);
	$countAllNews = $result2['COUNT(*)']; // всего записей
		paginator::$lastPage = ceil($countAllNews/paginator::$countView);  // последняя страница,  ceil -- Округляет дробь в большую сторону	
		$sql2->close();
}

elseif(isset($_GET['action']) && $_GET['action'] == 'write') { 
	 	
	$id = (int)$_GET['id'];
	paginator::$url_q = "/catalog?action=write&id=".$id.'&c='.$_GET['c']; // 
	//paginator::$url_q = $_GET; // 
	$sql = q("
	SELECT * 
	FROM `tovar`
	WHERE `id_podcat` = ".(int)$_GET['id']."
	ORDER BY `date` DESC
	LIMIT $startIndex, ".paginator::$countView."
	");
	
	$sql2 = q(" 
	SELECT COUNT(*)
	FROM `tovar`
	WHERE `id_podcat` = ".(int)$_GET['id']."
	Limit 1
	");

$result2 = mysqli_fetch_assoc($sql2);
$countAllNews = $result2['COUNT(*)']; // всего записей
	
	paginator::$lastPage = ceil($countAllNews/paginator::$countView);  // последняя страница,  ceil -- Округляет дробь в большую сторону	
	$sql2->close();
} elseif(!isset($_GET['c'])) {
	$sql = q(" 
SELECT *
FROM `tovar`
ORDER BY `date` DESC
LIMIT $startIndex, ".paginator::$countView."
");

// получение кол-ва записей
$sql2 = q(" 
SELECT COUNT(*)
FROM `tovar`
");

$result2 = mysqli_fetch_assoc($sql2);
$countAllNews = $result2['COUNT(*)']; // всего записей

// номер последней страницы
paginator::$lastPage = ceil($countAllNews/paginator::$countView); // последняя страница,  ceil -- Округляет дробь в большую сторону	
$sql2->close();
}
//****************


if(isset($_SESSION['info'])) {
	$info= $_SESSION['info'];
	unset($_SESSION['info']);
}