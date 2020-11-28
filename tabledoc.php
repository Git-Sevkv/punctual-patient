﻿﻿﻿<table>
<tr>
  <th align=center style="width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>ФИО пациента</h2></th>
  <th align=center style="width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>Время приёма</h2></th>
  <th align=center style="width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>Информация о приёме</h2></th>
 
  </tr>
  
  <?php
session_start();
$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');

if(isset($_GET["btn_end"]))
{
	$q=mysql_query("update CAV_pac 
                    set time_after='".$_GET["time_after"]."'
					where id=".$_GET["id"]);
}
$q=mysql_query("SELECT CAV_pac.* ,
				CAV_individ.fam,CAV_individ.name
				from CAV_pac 
				LEFT JOIN CAV_individ ON CAV_individ.id=CAV_pac.id_ind_pac
				where id_doc=".$_GET["id_doc"]."
				");
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

foreach ($qq as $r)
{
	if ($r["id_ind_pac"]!="")
		{
		echo "<tr>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\"><h3>".$r["fam"]." ".$r["name"]."</h3></td>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\"><h3>".$r["time_way"]."</h3></td>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">";
		if($r["time_after"]=="")
				echo "<form action=\"tabledoc.php\" method=get>
						<input name=btn_end type=submit value=\"Приём окончен\">
						<input name=time_after  style=\"display:none;\" value=\"".date("h:i:s")."\">
						<input name=id style=\"display:none;\" value=".$r["id"]." >
						<input name=id_doc style=\"display:none;\" value=".$r["id_doc"]." >
						</form>";
		echo "</td>
	  </tr>";
		}
	
}
?>

</table>

<p style="position:absolute;right: 200;">Я ушёл на <input style="width: 30;"></input> минут.<button>Подтвердить</button></p>