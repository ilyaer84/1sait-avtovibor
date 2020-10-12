<?php 
// функции

function wtf($array, $stop = false) {
	echo '<pre>'.print_r($array,1).'</pre>';
	if(!$stop) {
		exit();
	}
}

// ******* автозагрузка классов
/*
function __autoload($class){  
	include './libs/class_'.$class.'.php';

//	wtf($class);
	// exit;
}
*/

function my_autoloader($class) {
    include './libs/class_'.$class.'.php';
}

//************ */
//spl_autoload_register('my_autoloader');

// Начиная с версии PHP 5.3.0 можно использовать анонимные функции
spl_autoload_register(function ($class) {
    include './libs/class_'.$class.'.php';
});





// соединеи с БД с первого запроса, соединение-запрос, закрытия соединения, 
class DB {
	static public $mysqli = array();
	static public $connect = array(); // ($localhost,$user,$pass,$db)
	
	static public function _($key = 0) {
	//$mysqli  = new MySQLi($localhost,$user,$pass,$db);	// new MySQLi($localhost,$user,$pass,$db)
	  if(!isset(self::$mysqli['key'])) {
		if(!isset(self::$connect['server'])) // если не указан сервер то берем из классса CORE <- в config
			self::$connect['server'] = Core::$DB_LOCAL; 
		if(!isset(self::$connect['user'])) // если не указан user то берем из классса CORE <- в config
			self::$connect['user'] = Core::$DB_LOGIN;
		if(!isset(self::$connect['pass'])) // если не указан пароль то берем из классса CORE <- в config
			self::$connect['pass'] = Core::$DB_PASS;
		if(!isset(self::$connect['db'])) // если не указан имя базы то берем из классса CORE <- в config 
			self::$connect['db'] = Core::$DB_NAME;
		
		// создали подключение к БД
		self::$mysqli[$key] = @new mysqli(self::$connect['server'], self::$connect['user'], self::$connect['pass'], self::$connect['db']); 
		  // warning 
		  if(mysqli_connect_errno()){
			  echo 'Не удалось подключиться к Базе Данных';
				  exit;
		  }
		  if(!self::$mysqli[$key]->set_charset("utf8mb4")) {
			  echo 'Ошибка при загрузке набора символов utf8mb4: '.self::$mysqli[$key]->error; // стиль ооп
			  //error - переменная длявывода ошибок
			  /* стиль процедурный
			  mysqli_set_chatset("");
			  DB::mysqli[0]->set_chatset(""); // или  DB::_()->set_chatset("");
			  */
		  }
	}
		return self::$mysqli[$key];
  }
	static public function close($key=0) {  /// закрытие соединения? при работе с графикой закрываем соединеие, тк долгая обработка, по умолчанию прописываем $key=0 ( но при работе с другими  БД меняем)
		self::$mysqli[$key]->close();
		unset(self::$mysqli[$key]);
	}
}

/*
DB:: (0); // соединени с БД
DB::$mysqli(0)->query();
//ниже обьдиним
DB::_($key)->query(); 
DB::_($key) // создаст соединеие при помощи добавления в DB --> return self::$mysqli($key);

// DB::_($key)->query(); // DB - ссылка на класс // :: - статичный // _ - метод // $key - ключ ( можно не пердать тк по умолчанию - 0 
*/
//**********************


// q- запрос в БД +  запись ошибок в файл
function q($query,$key=0) {  // mysqli_query + проверка ошибок //s function q($query)

//s	global $link;  // $link =$GLOBALS['link'];	
//s	$res  = mysqli_query($link,$query);
	$res = DB::_($key)->query($query);
	
	if($res === false) { // если  просто if($res) - TRUE или FALSE 
		$info = debug_backtrace(); // debug_backtrace получить информацию о конкректной функции
    
    
		$error = "Запрос: ".$query."<br>\n".DB::_($key)->error."<br>\n".
				 "В файле: ".$info[0]['file']."<br>\n".
				 "В линии: ".$info[0]['line']."<br>\n".
				 "Дата: ".date("Y-m-d H:i:s")."<br>\n".
				 "====================================="; // Дебаг
		// Отправка уведомлений на почту
		// Логировать ошибки в файле своем file_put_contents('./log/mysql.log', strip_tags($quert)."\n\n"<FILE_APPEND); 
		file_put_contents('./logs/mysql.log', strip_tags($error)."\n\n", FILE_APPEND); // 
		echo $error;		
		exit();
	} else {
		return $res;
	}	
} 

function trimAll($el) { 	// убирает пробелы вначале и вконце
	if(!is_array($el)) {  //  если элемент не массив
		$el = trim($el);
	} else {
		$el = array_map('trimAll', $el); // замыкание, рекурсия функции ( в глубь)
	}
	return $el;  // возврат значения
}

function es($el, $key = 0) { //Экранирует специальные символы в строках для использования в выражениях SQL /s function es($el)
/* /s	
	if(!is_array($el)) {  //  если элемент не массив
		global $link;
		$el = mysqli_real_escape_string($link,$el); //Экранирует специальные символы в строках для использования в выражениях SQL
	} else {
		$el = array_map('es', $el); // замыкание, рекурсия функции ( в глубь)
	}
	return $el;  // возврат значения
	*/
	return DB::_($key)->real_escape_string($el);
}

function hc($el) {	// В HTML некоторые символы имеют особый смысл и должны быть представлены в виде HTML-сущностей, чтобы сохранить их значение. Эта функция возвращает строку, над которой проведены эти преобразования.
	if(!is_array($el)) {  //  если элемент не массив
		$el = htmlspecialchars($el);
	} else {
		$el = array_map('hc', $el); // замыкание, рекурсия функции ( в глубь)
	}
	return $el;  // возврат значения
}

function inAll($el) {	// в целые числа
	if(!is_array($el)) {  //  если элемент не массив
		$el = (int)($el);
	} else {
		$el = array_map('inint', $el); // замыкание, рекурсия функции ( в глубь)
	}
	return $el;  // возврат значения
}

function floatAll($el) {	// в не целы числа для денег
	if(!is_array($el)) {  //  если элемент не массив
		$el = (float)$el;
	} else {
		$el = array_map('inint', $el); // замыкание, рекурсия функции ( в глубь)
	}
	return $el;  // возврат значения
}

function myHash($var) {
	$salt ='ABC';
	$salt2 = 'CBA';
	$var = crypt(md5($var.$salt),$salt2); // md5 получает общую строку ($var.$salt); crypt получает через , (salt2 ) - втрой аргумент
	return $var;
}

function imgresize($file_path, $new_widt) {
	// получаем ширину и высоту исходника
	list($w,$h) = getimagesize($file_path); // list — Присваивает переменным из списка значения подобно массиву. спользуется для того, чтобы присвоить списку переменных значения за одну операцию. list() работала только с индексированными массивами и принимала числовые индексы начиная с 0. 
	$file_path[0] = $w;
	$file_path[1] = $h;
	//получаем коэфициент соотношения сторон
	$proportion = $h / $w;
	
	$new_w = $new_widt;
	$new_h = $new_w * $proportion; // Получаем высоту уменьшиной картинки пропорционально новой ширине
	
	$thumb =  imagecreatetruecolor($new_w, $new_h);
	
	$source =  imagecreatefromjpeg($file_path);
	
	//imagecopyresized($thumb, $source, 0,0,0,0,$new_w, $new_h, $w, $h);
	
	imagecopyresampled($thumb, $source, 0,0,0,0,$new_w, $new_h, $w, $h);
	
	imagejpeg($thumb, $_FILES['image']['tmp_name']);
	return $_FILES['image']['tmp_name'];
	imagedestroy($thumb);
	
}








