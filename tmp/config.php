<?php   // общие настройкм, переменные кот не меняются

define ('CREATED', 2020); // Создание константы (переменной которая задается раз - не изменная) в названии важно большие/маленькие буквы!!! Создаются в глобальной оласти видны везде(в функции и проге)


class Core {
	static $SKIN = 'default';
	static $CONT = 'modules'; // контроллер - папка
	static $DB_NAME = 'host1812201';
	static $DB_LOGIN = 'host1812201';
	static $DB_PASS = 'eeeef233';
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