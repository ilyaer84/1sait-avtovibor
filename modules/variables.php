<?php 		
	

// обработка  REWRITE

if(isset($_GET['route'])) { 
	$temp = explode('/', $_GET['route']) ; // explode - функция разложит массив по '/'

	// доп админка
	if($temp[0] == 'admin') { // in_array($temp[0], array('admin', 'partner', 'adversment') -  для использование нескольких вариантом системы 
		Core::$CONT = Core::$CONT.'/admin';
		Core::$SKIN = 'admin';
		unset($temp[0]);
	}
	
	$i = 0; // для админки 
	foreach($temp as $k=>$v ) {
		if($i == 0) {
			if(!empty($v)) {
				$_GET['module'] = $v; 
			}
		} elseif($i == 1) {
			if(!empty($v)) {
				$_GET['page'] = $v;
			}
		} else {
			$_GET['key'.($k-1)] = $v; // т.к. тут $k = 2 отнимим 1
		}
		++$i;
	}
	unset($_GET['route']);
	 //wtf($_GET);
}

//****	 проверка на каталоги от него и вывод на 404
 /*
if(!isset($_GET['module'])) {
	$_GET['module'] = 'static';
} else {
	$res = q("
		SELECT *
		FROM `pages`
		WHERE `module` = '".es($_GET['module'])."'
		limit 1
	");
	if(!$res->num_rows) {  //s if(!mysqli_num_rows($res))   
	header("location: /404");
	exit();
	} else {
		$staticpage = $res->fetch_assoc(); //s  mysqli_fetch_assoc($res)
		$res->close();
		 if($staticpage['static']  == 1) {
			$_GET['module'] = 'staticpage';
			$_GET['page'] = 'one';
		}
	}
	
	// формируется массив
	
} */

$alloweb = array('catalog','errors','news','static'); // v skins - tpl(html)
	$alloweb2 = array('static','contacts','news','errors', 'cab', 'admin');	
		if(!isset($_GET['module'])) {
			$_GET['module'] = 'static';	
			
		} elseif(!in_array($_GET['module'], $alloweb) ) { // доп проверка из-за админки
			header("location: /errors/404");
			exit(); 
		}  /* elseif(!in_array($_GET['module'], $alloweb2) && Core::$SKIN == 'admin') {
			header("location: /errors/404");
			exit();
		}  
*/
	
// 
if(!isset($_GET['page'])) {
	$_GET['page'] = 'main';
}


// доп проверка, чтобы не мог переходить и пользоваться другим спец символами
/*
if(!preg_match('#^[a-z-_]*$#iu', $_GET['page'])) { //preg_match — Выполняет проверку на соответствие регулярному выражению
	header("location: /404");
	exit(); 
} 
*/
// работа сформой
if(isset($_POST)) {
	$_POST = trimAll($_POST);
}