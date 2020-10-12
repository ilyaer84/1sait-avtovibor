<?php
//include './libs/class_Mail.php'; // вызов класса бе автолоад

//Mail::testMail(); // мспользование класса с автолоад


// Пагинатор

class Paginator {				// глобальная оласть видимости
	static $countView = 5; // количество материалов на странице
	static $pageNum = 1; // номер страницы
	static $lastPage = 5; // последняя страница
	
	static $url = '/news/news'; // адрес страницы, для которой и создаётся Pagination.
	static $url_q = '/news/news?action=write&id=$id'; // адрес страницы с доп парматром

	
	
	static function showPaginator() {
		
		echo ' Переход по страницам <br><ul>';
		
        if(self::$pageNum > 1 and isset($_GET['action']) && $_GET['action'] == 'write') { 
			
			 self::$pageNum=self::$pageNum-1;
			
echo '<li><a href=".'.self::$url_q.'&num=1">&lt;&lt;</a></li>
			<li><a href='.self::$url_q.'&num='.self::$pageNum.' rel=\"prev\">&lt;</a></li>' ;			
			
	} elseif(self::$pageNum > 1) { 
			self::$pageNum=self::$pageNum-1;
			echo "<li><a href=\"".self::$url."?num=1\" >&lt;&lt;</a></li>
            <li><a href=\"".self::$url."?num=".self::$pageNum."\" rel=\"prev\">&lt;</a></li> ";
		 }		
			
		
	for($i = 1; $i<=self::$lastPage; $i++) {
				
		if((isset($_GET['action']) && $_GET['action'] == 'write')) { 
				
			//echo "<li =($i == ".self::$pageNum.") ? : '';> <a href=\"".self::$url_q."&num=$i>\"$i> </a> </li> ";           
				echo '<li> <a href="'.self::$url_q.'&num='.$i.'" rel="next">'.$i.' </a> </li>';
				
        } else {    
			//echo "<li =($i == ".self::$pageNum.") ? : '';> <a href=\"/news/news?num=$i\">$i</a> </li>";			
				echo "<li> <a href=\"".self::$url."?num=$i\" rel=\"next\">$i</a> </li>";
	} 
				
				
}       if(!isset($_GET['num'])) { // номер страницы
	paginator::$pageNum=1;	
} else {
	 paginator::$pageNum = $_GET['num'];
}
       if((self::$pageNum < self::$lastPage) and isset($_GET['action']) && $_GET['action'] == 'write') { 
		
			  self::$pageNum=self::$pageNum+1;
			 echo "<li><a href=\"".self::$url_q."&num=".self::$pageNum."\" rel=\"next\">&gt;</a></li> 
			 <li><a href=\"".self::$url_q."&num=".self::$lastPage."\">&gt;&gt;</a></li>";		 
 } 	
		elseif(self::$pageNum < self::$lastPage) { 			
			self::$pageNum=self::$pageNum+1;			 
			 echo "<li><a href=\"".self::$url."?num=".self::$pageNum."\" rel=\"next\">&gt; </a></li>
            <li><a href=\"".self::$url."?num=".self::$lastPage."\">&gt;&gt; </a></li> ";		
         } 
    echo '</ul>';			
		}
		
}
/*
	
Paginator::showPaginator();			// вызов метода::функция или свойства
echo '<hr style=" margin: 0px">' ;
paginator::$howpages = 5;
paginator::showPaginator();

*/
