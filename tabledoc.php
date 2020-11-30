﻿﻿﻿﻿﻿﻿<table>
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
                    set time_after='".date("H:i:s")."'
					where id=".$_GET["id"]);
	$q=mysql_query("SELECT * from CAV_pac where id=".$_GET["id"]);
	while ($str=mysql_fetch_array($q,MYSQL_ASSOC)){if($str["id"]!=""){$tt0=$str["time"];$ta0=$str["time_after"];$id_doc0=$str["id_doc"];$dt0=$str["date_p"];}}
	$q=mysql_query("SELECT * from CAV_pac where id_doc=".$str["id_doc"]." and date_p='".$str["date_p"]."' and time_after is null order by time");

unset($qq);				
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}
$nfirst=0;$tfirst=0;
foreach ($qq as $r)
	if ($r["id"]!="")
		{
		if($nfirst==0)
			{$tfirst=explode(":",$r["time"]);
			 if(!isset($tfirst[2]))$tfirst[2]=0;
			 $q=mysql_query("update CAV_pac 
                    set time_way='".$str["time_after"]."'
					where id=".$r["id"]);
			}
			else{$ttr=explode(":",$r["time"]);
				 if(!isset($ttr[2]))$ttr[2]=0;
				 $ttstr=explode(":",$str["time_after"]);
				 if(!isset($ttstr[2]))$ttstr[2]=0;
				 $ttt=$ttstr[0]*60*60+$ttstr[1]*60+$ttstr[2]+($ttr[0]*60*60+$ttr[1]*60+$ttr[2]-$ttr[0]*60*60-$ttr[1]*60-$ttr[2]);
				 $q=mysql_query("update CAV_pac 
                    set time_way='".($ttt/3600)."-".($ttt/3600)."-".($ttt/3600)."'
					where id=".$r["id"]);
				}
		$nfirst=1;
		}
	
}
if(isset($_GET["btn_beg"]))
{
	$q=mysql_query("update CAV_pac 
                    set time_way='".date("H:i:s")."'
					where id=".$_GET["id"]);
}
$q=mysql_query("SELECT CAV_pac.* ,
				CAV_individ.fam,CAV_individ.name
				from CAV_pac 
				LEFT JOIN CAV_individ ON CAV_individ.id=CAV_pac.id_ind_pac
				where id_doc=".$_GET["id_doc"]."
				");
unset($qq);				
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

foreach ($qq as $r)
{
	if ($r["id_ind_pac"]!="")
		{
		echo "<tr>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\"><h3>".$r["fam"]." ".$r["name"]."</h3></td>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\"><h3>".$r["time_way"]."</h3>
		 <form action=\"tabledoc.php\" method=get>
						<input name=btn_beg type=submit value=\"Начало приёма\">
						<input name=id style=\"display:none;\" value=".$r["id"]." >
						<input name=id_doc style=\"display:none;\" value=".$r["id_doc"]." >
						</form></td>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">";
		if($r["time_after"]=="")
				echo "<form action=\"tabledoc.php\" method=get>
						<input name=btn_end type=submit value=\"Приём окончен\">
						<input name=id style=\"display:none;\" value=".$r["id"]." >
						<input name=id_doc style=\"display:none;\" value=".$r["id_doc"]." >
						</form>";
				else echo $r["time_after"];
		echo "</td>
	  </tr>";
		}
	
}
?>

</table>

<p style="position:absolute;right: 200;">Я ушёл на <input style="width: 30;"></input> минут.<button>Подтвердить</button></p>