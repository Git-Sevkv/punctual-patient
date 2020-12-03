﻿<h1 style="position: absolute;left: 26;top:1;">Список ближайших пациентов</h1>
<script>
setInterval(function() {
 window.location = "table_pers.php";
}, 7000);
</script>
<table  style="position: absolute; top: 60;">
<tr>
  <th align=center style="width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>ФИО пациента</h2></th>
  <th align=center style="width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>Время приёма</h2></th>
  <th align=center style="width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>Время прихода в больницу</h2></th>
  </tr>

<?php
$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');

$q=mysql_query("SELECT CAV_pac.*,
				CAV_individ.fam, CAV_individ.name,CAV_individ.s_name
				from CAV_pac 
				LEFT JOIN CAV_individ ON CAV_individ.id=CAV_pac.id_ind_pac 
				where time_after is null and date_p='".date("Y-m-d")."' order by time
		");
		
if(isset($_GET["btn_place"]))
{
	$q=mysql_query("update CAV_pac 
                    set time_arrived='".date("H:i:s")."'
					where id=".$_GET["id"]);
}					
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

	foreach ($qq as $r)
{
	if ($r["id"]!="")
	{
	echo "<tr>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\"><h3>".$r["fam"]." ".$r["name"]."</h3></td>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\"><h3>".$r["time_way"]."</h3></td>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">";
		if($r["time_arrived"]=="")
				echo "<form action=\"table_pers.php\" method=get>
						<input name=btn_place type=submit value=\"Зашел в больницу\">
						<input name=time_arrived style=\"display:none;\" value=".date("H:i:s")." >
						<input name=id style=\"display:none;\" value=".$r["id"]." >

						</form>";
						else echo $r["time_arrived"];
		echo "</td>
  </tr>";
	}
}		


?>

  </table>

<a href="http://agniinfo.ru/st2016/Chernaya/hospital/registration.php"
  style="position: absolute;left: 650;top: 40"><button style="background-color: #f5e8d0;width: 130px; height: 40px;border-radius: 10px;font-style: italic;">Вернуться назад
  </button><img src="strelka.png" width="40"
   onmouseover="this.width=50;"
 onmouseout="this.width=40;"></a>