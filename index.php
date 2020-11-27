﻿﻿<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/css; charset=utf-8">

<?php
if(!isset($_GET["id_ind"]))die("Нет данных!");
error_reporting(0);
session_start();
foreach($_SESSION["mess"] as $k_ms => $ms)
	{foreach($ms as $kk_ms => $mms)
		{foreach($mms as $kkk_ms => $mmms)
			unset($_SESSION["mess"][$k_ms][$kk_ms][$kkk_ms]);
		unset($_SESSION["mess"][$k_ms][$kk_ms]);
		}
	unset($_SESSION["mess"][$k_ms]);
	}
unset($_SESSION["mess"]);
include("holiday.php");
$w_rus=[1 => "Понедельник",2 => "Вторник",3 => "Среда",4 => "Четверг",5 => "Пятница",6 => "Суббота",7 => "Воскресенье"];
$m_rus=[1 => "Январь",2 => "Февраль",3 => "Март",4 => "Апрель",5 => "Май",6 => "Июнь",7 => "Июль",8 => "Август",9 => "Сентябрь",10 => "Октябрь",11 => "Ноябрь",12 => "Декабрь"];
$i=1;
while(file_exists("m".$_GET["id_ind"]."/mess".$i.".php"))
	{
	include("m".$_GET["id_ind"]."/mess".$i.".php");
	$i++;
	}

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
background: #77dd77 ;
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
$m=date("m");$m=date("m");
if(isset($_GET["m"]))$m=$_GET["m"];
$Y=date("Y");
if(isset($_GET["Y"]))$Y=$_GET["Y"];
$wd=date("w",strtotime($Y."-".$m."-01"));
if($wd==0)$wd=7;
echo "<table style=\"border-radius: 10px;border-spacing: 0;table-layout:fixed;width:430px;\">
<tr><th colspan=7 class=th_td style=\"border-radius: 10px;\">";
$str_get="";
foreach($_GET as $kget => $get)
	if(($kget!=m)&&($kget!=Y))
		{if($str_get=="")$str_get=$kget."=".$get;else $str_get.="&".$kget."=".$get;}
$YY=$Y;
$mm=$m-1;if($mm==0){$YY=$YY-1;$mm=12;}
if($str_get=="")$str_get="Y=".$YY."&m=".$mm;else $str_get.="&Y=".$YY."&m=".$mm;
echo "<a href=\"index.php?".$str_get."\"><img src=\"pr.png\" style=\"position:relative;right:50;top:5;width:25;\"></a>";
echo " ".$m_rus[$m]." ";
if($Y!=$cur_Y)echo $Y." ";
$str_get="";
foreach($_GET as $kget => $get)
	if(($kget!=m)&&($kget!=Y))
		{if($str_get=="")$str_get=$kget."=".$get;else $str_get.="&".$kget."=".$get;}
$YY=$Y;
$mm=$m+1;if($mm>12){$YY=$YY+1;$mm=1;}
if($str_get=="")$str_get="Y=".$YY."&m=".$mm;else $str_get.="&Y=".$YY."&m=".$mm;
echo "<a href=\"index.php?".$str_get."\"><img src=\"next.png\" style=\"position:relative;left:50;top:5;width:25;\"></a>";
echo "</th></tr>
<tr><th class=th_td>Пн.</th><th class=th_td>Вт.</th><th class=th_td>Ср.</th><th class=th_td>Чт.</th><th class=th_td>Пт.</th><th class=th_td>Сбб.</th><th class=th_td>Вск.</th></tr>
<tr>";
for($i=1;$i<$wd;$i++)echo "<td class=th_td></td>";
for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $m, $Y);$i++)
	{$wd=date("w",strtotime($Y."-".$m."-".$i));
	 if($wd==0)$wd=7;
	 echo "<td  class=th_td 
			onclick=\"window.location.replace('cal_day.php?id_ind=".$_GET["id_ind"]."&c_d=".$i."&c_m=".$m."&c_Y=".$Y."');\"
			>";
	 echo "<table style=\"width:100%;height:100%;";
	 if (($i==$cur_d)&&($m==$cur_m)&&($Y==$cur_Y))
		 echo "border-style:solid;border-color:red;border-width:2;";
	 echo "\">";
	 echo "<tr><td class=td_in>";
	 if($i-0>9-0)$str_d=$i;else $str_d="0".$i;
	 if($m-0>9-0)$str_m=$m;else $str_m="0".$m;
	 $str_Y=$Y;
	 if(isset($_SESSION["holiday"][$str_d."_".$str_m]))echo "<img title=\"".$_SESSION["holiday"][$str_d."_".$str_m]."\" src=\"hol.png\" style=\"width:100%;\">";
	 echo "</td><td class=td_in></td><td class=td_in></td></tr>";
	 echo "<tr><td class=td_in></td><td class=td_in>".$i."</td><td class=td_in></td></tr>";
	 echo "<tr><td class=td_in colspan=3>";
	 if(isset($_SESSION["mess"][$str_d."_".$str_m."_".$str_Y]))
		 foreach($_SESSION["mess"][$str_d."_".$str_m."_".$str_Y] as $ms)
			{
			 echo "<div style=\"width:5px;height:5px;float:left;background-color:";
			 if(isset($ms["w_ok"])&&($ms["w_ok"]==1))echo "gray";else echo "red";
			 echo ";\"
					title=\"".$ms["body"]."\n".$ms["from"]."\n\"></div>
					<div style=\"width:2px;height:5px;float:left;background-color:#F8E391;\"></div>";
			}
	 echo "</td></tr>";
	 echo "</table></td>";
	 if($wd==7)echo "</tr>";
	}
if($wd!=7){for($i=$wd+1;$i<8;$i++)echo "<td class=th_td></td>";echo "</tr>";}	
echo "</table>";
?>