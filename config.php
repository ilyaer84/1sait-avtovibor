<?php   // общие настройкм, переменные кот не меняются

define ('CREATED', 2020); // Создание константы (переменной которая задается раз - не изменная) в названии важно большие/маленькие буквы!!! Создаются в глобальной оласти видны везде(в функции и проге)


class Core {
	static $SKIN = 'default';
	static $CONT = 'modules'; // контроллер - папка
	static $DB_NAME = 'auto';
	static $DB_LOGIN = 'test';
	static $DB_PASS = 'test1234';
	static $DB_LOCAL = 'localhost';
	static $DOMAIN = 'http://auto-vibor/';
	static $JS = array();
	static $CSS = array();
	static $META = array(
		'title'=>'стандартный TITLE',
		'description'=>'d',
		'keywords'=>'k'
	);
}

// обращение echo core::$SKIN;
