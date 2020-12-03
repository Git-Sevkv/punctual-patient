

<?php
session_start();
$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');

$q=mysql_query("SELECT CAV_doctor.*
		from CAV_doctor 
		where id_ind_doc=".$_SESSION["id"]."");
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

echo "<select style=\"position: absolute; top: 7%;left: 19%;\" onclick=\"document.getElementById('fr_sp').src='calendar/index.php?id_doc='+this.value;\">";
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
<h1 style="position: absolute;left: 1%; top: 1%;font-style: italic;text-decoration:underline;">Выберите врача:</h1>

<a href="http://agniinfo.ru/st2016/Chernaya/hospital/registration.php"
  style="position: absolute;left: 55%;top: 10%"><button style="background-color:#f5e8d0;width: 130px;height: 40px;border-radius: 10px;font-style: italic;">Вернуться назад</button><img src="strelka.png" width="40"
 onmouseover="this.width=50;"
 onmouseout="this.width=40;"></a>