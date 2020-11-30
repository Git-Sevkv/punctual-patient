﻿﻿﻿﻿<h1 style="position: absolute;left: 1%;top:1%;">Выберите врача</h1>
<?php
session_start();
$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');
echo "SELECT CAV_doctor.*
		from CAV_doctor 
		where id_ind_doc=".$_SESSION["id"]."";
$q=mysql_query("SELECT CAV_doctor.*
		from CAV_doctor 
		where id_ind_doc=".$_SESSION["id"]."");
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

echo "<select onclick=\"document.getElementById('fr_sp').src='calendar/index.php?id_doc='+this.value;\">";
foreach($qq as $r)
	if($r["doctor"]!="")
		{
		echo "<option value=".$r["id"].">";
		echo $r["doctor"];
		echo "</option>";
		}
echo "</select>";

	  
?>
<iframe id=fr_sp src=""
        style="position: absolute;left: 1%;top: 10%;width:98%;height:80%;"
></iframe>
  <a href="http://agniinfo.ru/st2016/Chernaya/hospital/registration.php"
  style="position: absolute; top: 30; left: 300">Вернуться назад</a>