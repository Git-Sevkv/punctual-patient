﻿﻿<meta http-equiv="Content-Type" content="text/css; charset=UTF8">
<style>
table {
font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
font-size: 14px;
border-radius: 10px;
border-spacing: 0;
text-align: center;
}
th {
background: #77dd77 ;
color: #A0A0A0;
text-shadow: 0 1px 1px #2D2020;
padding: 10px 20px;
}
th, td {
border-style: solid;
border-width: 0 1px 1px 0;
border-color: white;
}
th:first-child, td:first-child {
text-align: left;
}
th:first-child {
border-top-left-radius: 10px;
}
th:last-child {
border-top-right-radius: 10px;
border-right: none;
}
td {
padding: 10px 20px;
background: #F8E391;
}
tr:last-child td:first-child {
border-radius: 0 0 0 10px;
}
tr:last-child td:last-child {
border-radius: 0 0 10px 0;
}
tr td:last-child {
border-right: none;
}
</style>
<?php
date_default_timezone_set('Europe/Moscow');
$datetime=date("Y-m-d H:i:s");
$d=date("d");
$m=date("m");
$Y=date("Y");

$wd=date("w",strtotime($Y."-".$m."-01"));
if($wd==0)$wd=7;
echo "<table><tr><th>Пн.</th><th>Вт.</th><th>Ср.</th><th>Чт.</th><th>Пт.</th><th>Сбб.</th><th>Вск.</th></tr><tr>";
for($i=1;$i<$wd;$i++)echo "<td></td>";
for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $m, $Y);$i++)
	{$wd=date("w",strtotime($Y."-".$m."-".$i));
	 if($wd==0)$wd=7;
	 echo "<td ";
	 if (($i==$d)&&($m==date("m"))&&($Y==date("Y")))
		 echo "style=\"border-style:solid;border-color:red;border-width:2;\"";
	 echo ">".$i."</td>";
	 if($wd==7)echo "</tr>";
	}
if($wd!=7){for($i=$wd+1;$i<8;$i++)echo "<td></td>";echo "</tr>";}	
echo "</table>";
?>