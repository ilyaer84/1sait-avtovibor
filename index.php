<?php // ЗАГОЛОВКИ
	error_reporting(0);
	header('content-type: text/html; charset=utf-8');
 // запись php ошибок в файл (без вывода на экран)
	ini_set('display_errors', 'Off');
	ini_set("error_log", "logs/php.log");

// Конфиг сайта
include_once './config.php'; //  переменные
include_once './libs/default.php'; // функции
include_once './modules/variables.php';

//session_start () ; 	

// Роутер обработка наших скриптор, работа с базой данной *******************************
ob_start();
include './'.Core::$CONT.'/allpage.php';  // общий контроллер для всех страниц

 if(!file_exists('./'.Core::$CONT.'/'.$_GET['module'].'/'.$_GET['page'].'.php') or !file_exists('./skins/'.Core::$SKIN.'/'.$_GET['module'].'/'.$_GET['page'].'.html'))  { 
// file_exists - проверка существования файла в файловой системы
	 header("Location: /errors/404");
exit(); }

include './skins/default/static/header.html';	
include './skins/default/static/menu.html';
include './'.Core::$CONT.'/'.$_GET['module'].'/'.$_GET['page'].'.php'; // подключаем контроллер для персональной странице

include './skins/'.Core::$SKIN.'/'.$_GET['module'].'/'.$_GET['page'].'.html';  // подключаем вид стрвнички


$content = ob_get_contents(); // запись всех контроллеров потом выведем в index.html
ob_end_clean();

//*******************************************************


include './skins/'.Core::$SKIN.'/index.html'; 
include './skins/default/static/footer.html';