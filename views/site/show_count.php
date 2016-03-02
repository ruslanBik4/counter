<?php
use yii\helpers\Html;
use app\models\Count;
use yii\db\Query;

function PrintStat($stat, $period) {
	
	$options = [ "class" => "not-set"];
	
	if ($period == 'today')
		echo Html::tag('p', "С хоста {$stat[hosts]}  просмотров: {$stat[views]}", $options );	 
	else
		echo Html::tag('p', "За {$stat[date]}  Уникальных посетителей: {$stat[hosts]}  Просмотров: {$stat[views]}", 	$options );	 
}

// Экранируем параметр
$rows_in_page = ( is_numeric( $rows_in_page ) ? $rows_in_page : integer($rows_in_page) );

$option_title = [ "class" => "text-uppercase" ];

// вібираем временной период
if ($period == 'today')
{
	$date = date("Y-m-d");	
	// отбіраем данние за сегодня
	echo Html::tag('p', "Показ статистики за $date.", $option_title );	
	$query = (new Query())
			->select( [ 'date', 'ip_adress as hosts', 'views'] )
		    ->from('count')
		    ->where( [ 'date' => $date ] );
}
else if ($period == 'all')
{
	echo Html::tag('p', "Показ статистики за все время.", $option_title );	
	$query = (new Query())
			->select( [ 'date', 'count(*) as hosts', 'sum(`views`) as views'] )
		    ->from('count')
		    ->groupBy( ['date' ] );
}

	// відаем данніе пакетом
	foreach ($query->batch($rows_in_page) as $stats) {
	    // $stats это массив из 100 или менее строк из таблицы пользователей
	    foreach( $stats as  $stat)
		    PrintStat($stat, $period);
	}
?>
<div>
	<span> Показать данные за </br>
		<a href='index.php?r=site/show_count&period=today' >сегодня</a> </br>
		<a href='index.php?r=site/show_count&period=all'>все время</a> 
	</span> 
</div>