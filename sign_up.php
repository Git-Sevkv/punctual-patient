<h1 style="position: absolute;left: 1%;top:1%;">Выберите врача</h1>
<?php
$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');

$q=mysql_query("SELECT CAV_doctor.* ,
		CAV_individ.fam
		from CAV_doctor 
		LEFT JOIN CAV_individ ON CAV_individ.id=CAV_doctor.id_ind_doc");
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

echo "<select onclick=\"document.getElementById('fr_sp').src='calendar/index.php?id_ind='+this.value;\">";
foreach($qq as $r)
	if($r["fam"]!="")
		{
		echo "<option value=".$r["id"].">";
		echo $r["doctor"]." ".$r["fam"];
		echo "</option>";
		}
echo "</select>";

	  
?>
<iframe id=fr_sp src="index.php?id=1"
        style="position: absolute;left: 1%;top: 10%;width:98%;height:80%;"
></iframe>