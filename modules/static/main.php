<?php
Core::$META['title'] = 'Автотовары, Мультимедиа, Авто - Аксессуары';
Core::$META['description'] ="
автозвук ваз, автозвук Казань, автозвук Набережные Челны, автозвук Самара, автозвук Ижевск,
 автозвук Чебоксары, автозвук Тольятти, 
автомагнитола, автомагнитола купить, автомагнитола цена, автомагнитола ваз,
автомагнитола Казань, автомагнитола автомагнитола Челны, автомагнитола Самара, автомагнитола Ижевск,
 автомагнитола Чебоксары, автомагнитола Тольятти, 
 магнитола ваз, магнитола на гранту, магнитола на весту, 
магнитола купить, магнитола цена, магнитола для lada, магнитола lada vesta, магнитола lada granta,
магнитола Казань, магнитола автомагнитола Челны, магнитола Самара, магнитола Ижевск,
 магнитола Чебоксары, магнитола Тольятти, 
 2 din магнитола, магнитола ваз, 2 din android магнитола на гранту, 2 din android магнитола на весту, 
2 din магнитола купить, магнитола цена, 2 din android lada, 2 din android lada vesta, 2 din android lada granta,
2 din android Казань, 2 din android автомагнитола Челны, 2 din android Самара, 2 din android Ижевск,
 2 din android Чебоксары, 2 din android Тольятти, 
заказать онлайн андроид магнитолу на лада";

$cat = q(" 
SELECT *
FROM `cat`
");

//$array[] = array();
$sql = q("
	SELECT * 
	FROM `tovar`	
	ORDER BY `date` DESC
	LIMIT 1, 3
	");

/*
if(mysqli_num_rows($res2)) { // если есть записи
// implode ('<td></td>', $_POST['ids']); функция обьединения массива через (1- символ обед - можно запятая, 2 - переменные) в строку ( из массива в строку)
$array = implode(',',$array);
*/
