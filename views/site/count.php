<?php
use yii\helpers\Html;
use app\models\Count;

// Получаем IP-адрес посетителя и сохраняем текущую дату
$visitor_ip = $_SERVER['REMOTE_ADDR'];
$date = date("Y-m-d");

// 
$count = Count::find()->where( ['ip_adress' => $visitor_ip, 'date' => $date ] );

if ( $count->count() == 0) // нет посетителей с хоста $visitor_ip за текущую дату
{ 
	// создаем новую строку в перечне
	$count = new Count();
	
	// в базу IP-адрес текущего посетителя, дату и счетчик просмотра устанавливаем в 1
	$count->ip_adress = $_SERVER['REMOTE_ADDR'];
	$count->date = $date;
// 	$count->views = 1;
	$count->save();
}
else
{
	$count = Count::findOne( ['ip_adress' => $visitor_ip, 'date' => $date ] );
	$count->updateCounters(  ['views' => 1 ] ); // приращиваем счетчик посещений
	
}

$count = Count::find()->where( [ 'date' => $date ] )->groupBy( ['ip_adress', 'date' ] );

?>
<p> За сегодня <br/>
	Уникальных посетителей: <?=$count->count()?> <br/>
    Просмотров: <?=$count->sum('views')?>
</p>