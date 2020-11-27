﻿<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/css; charset=utf-8">

<?php
if(!isset($_GET["id_ind"])||!isset($_GET["c_Y"])||!isset($_GET["c_m"])||!isset($_GET["c_d"]))die("Нет данных!");
$d=$_GET["c_d"];
$m=$_GET["c_m"];
$Y=$_GET["c_Y"];
error_reporting(0);
session_start();
include("holiday.php");
$w_rus=[1 => "Понедельник",2 => "Вторник",3 => "Среда",4 => "Четверг",5 => "Пятница",6 => "Суббота",7 => "Воскресенье"];
$m_rus=[1 => "Января",2 => "Февраля",3 => "Марта",4 => "Апреля",5 => "Мая",6 => "Июня",7 => "Июля",8 => "Августа",9 => "Сентября",10 => "Октября",11 => "Ноября",12 => "Декабря"];
$i=1;

?>
<style>

table {
font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
font-size: 16px;
font-weight:600;
text-align: center;
text-shadow:1px 1px 1px white;
}
td {
padding: 0px 0px 0px 0px;
background: #F8E391;
}
th.th_td {
background: #BCEBDD;
color: #A0A0A0;
text-shadow: 0 1px 1px #2D2020;
padding: 10px 20px;
}
.th_td {
border-style: solid;
border-width:1px;
border-color: white;
width:60px;height:60px;
}
th.th_td:first-child {
border-top-left-radius: 10px;
}
tr.th_td:first-child th.th_td:first-child {
border-radius: 10px 10px 10px 10px;
text-align:center;
}
th.th_td:last-child {
border-top-right-radius: 10px;
border-right: none;
}
tr.th_td:last-child td:first-child {
border-radius: 0 0 0 10px;
}
tr.th_td:last-child td:last-child {
border-radius: 0 0 10px 0;
}
tr.th_td td.th_td:last-child {
border-right: none;
}
.td_in{width:33%;height:33%;}
</style>
<?php

date_default_timezone_set('Europe/Moscow');
$datetime=date("Y-m-d H:i:s");
$cur_d=date("d");
$cur_m=date("m");
$cur_Y=date("Y");
$m=date("m");
if(isset($_GET["c_m"]))$m=$_GET["c_m"];
$Y=date("Y");
if(isset($_GET["c_Y"]))$Y=$_GET["c_Y"];
$wd=date("w",strtotime($Y."-".$m."-01"));
if($wd==0)$wd=7;
echo "<table style=\"border-radius: 10px;border-spacing: 0;table-layout:fixed;width:430px;\">
<tr><th class=th_td style=\"border-radius: 10px;\" onclick=\"window.location.replace('index.php?id_ind=".$_GET["id_ind"]."&m=".$m."&Y=".$Y."');\" ><img src=\"pr.png\" style=\"position:relative;right:50;top:5;width:25;\">";
$str_get="";
foreach($_GET as $kget => $get)
	if(($kget!=m)&&($kget!=Y))
		{if($str_get=="")$str_get=$kget."=".$get;else $str_get.="&".$kget."=".$get;}

echo $d." ".$m_rus[$m]." ";
if($Y!=$cur_Y)echo $Y." ";

echo "</th></tr>";

	 if($d-0>9-0)$str_d=$d;else $str_d="0".$d;
	 if($m-0>9-0)$str_m=$m;else $str_m="0".$m;
	 $str_Y=$Y;
	 if(isset($_SESSION["holiday"][$str_d."_".$str_m]))echo "<tr><td class=th_td><img src=\"hol.png\" style=\"width:20;padding-right:20;\">".$_SESSION["holiday"][$str_d."_".$str_m]."</td></tr>";

	
echo "</table>";
?>