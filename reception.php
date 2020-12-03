﻿<meta name="viewport" content="width=device-width, initial-scale=1">
﻿<script>
setInterval(function() {
  window.location = "reception.php";
}, 3000);
</script>
<table>
<tr>
<th align=center style="width:200;height:100;border-style:solid;border-width:1;background-color: #77dd77";><h2>Специальность</h2></th>
  <th align=center style="width:200;height:100;border-style:solid;border-width:1;background-color: #77dd77";><h2>ФИО врача</h2></th>
  <th align=center style="width:200;height:100;border-style:solid;border-width:1;background-color: #77dd77";><h2>Время приёма</h2></th>
 
  </tr>
<?php
session_start();
$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');

$q=mysql_query("SELECT CAV_pac.* ,
				CAV_doctor.doctor, CAV_individ.fam,CAV_individ.name
				from CAV_pac 
				LEFT JOIN CAV_doctor ON CAV_doctor.id=CAV_pac.id_doc
				LEFT JOIN CAV_individ ON CAV_doctor.id_ind_doc=CAV_individ.id
				where id_ind_pac=".$_SESSION["id"]."
				");
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

foreach ($qq as $r)
{
	if ($r["doctor"]!="")
	echo "<tr>
  <td align=center style=\"width:200;height:100;border-style:solid;border-width:1;background-color: #f5e8d0;\";><h3>".$r["doctor"]."</h3></td>
  <td align=center style=\"width:200;height:100;border-style:solid;border-width:1;background-color: #f5e8d0;\";><h3>".$r["fam"]." ".$r["name"]."</h3></td>
  <td align=center style=\"width:200;height:100;border-style:solid;border-width:1;background-color: #f5e8d0;\";><h3>".$r["time_way"]."</h3></td>
  </tr>";
	
}
?>

</table>

 <a href="http://agniinfo.ru/st2016/Chernaya/hospital/registration.php"
  style="position: absolute; top: 10; left: 650px"><button style="background-color: #f5e8d0;width: 130px; height: 40px;border-radius: 10px;font-style: italic;">Вернуться назад</button><img src="strelka.png" width="40"
 onmouseover="this.width=50;"
 onmouseout="this.width=40;"></a>