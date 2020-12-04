﻿﻿<meta name="viewport" content="width=device-width, initial-scale=1">
﻿<?php
session_start();
?>
﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿<script>
setInterval(function() {
  window.location = 'tabledoc.php?id_doc=<?php echo $_GET["id_doc"]; ?>&c_Y=<?php echo $_GET["c_Y"]; ?>&c_m=<?php echo $_GET["c_m"]; ?>&c_d=<?php echo $_GET["c_d"]; ?>&break_time=<?php echo $_GET["break_time"]; ?>';
}, 10000);
</script>

﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿﻿<table>
<tr>
  <th align=center style="width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>ФИО пациента</h2></th>
  <th align=center style="width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>Время приёма</h2></th>
  <th align=center style="width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>Информация о приёме</h2></th>
   <th align=center style="width:200;height:40;border-style:solid;border-width:1;background-color: #77dd77";><h2>Время прибытия в больницу</h2></th>
 
  </tr>
  
  <?php

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
	echo "SELECT * from CAV_pac where id_doc=".$id_doc0." and date_p='".$dt0."' and time_after is null order by time";
	$q=mysql_query("SELECT * from CAV_pac where id_doc=".$id_doc0." and date_p='".$dt0."' and time_after is null order by time");

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
                    set time_way='".$ta0."'
					where id=".$r["id"]);
			}
			else{$ttr=explode(":",$r["time"]);
				 if(!isset($ttr[2]))$ttr[2]=0;
				 $ttstr=explode(":",$ta0);
				 if(!isset($ttstr[2]))$ttstr[2]=0;
				 $ttt=$ttstr[0]*60*60+$ttstr[1]*60+$ttstr[2]+($ttr[0]*60*60+$ttr[1]*60+$ttr[2]-$tfirst[0]*60*60-$tfirst[1]*60-$tfirst[2]);
				
				echo "update CAV_pac 
				set time_way='".floor($ttt/3600).":".floor(($ttt-(floor($ttt/3600)*60*60))/60).":".($ttt % 60)."'
				where id=".$r["id"]."";
				 
				 $q=mysql_query("update CAV_pac 
                   set time_way='".floor($ttt/3600).":".floor(($ttt-(floor($ttt/3600)*60*60))/60).":".($ttt % 60)."'
					where id=".$r["id"]."");
				}
		$nfirst=1;
		}
	
}
if(isset($_GET["btn_beg"]))
{

	$q=mysql_query("update CAV_pac 
                    set time_way='".date("H:i:s")."', time_way_fact='".date("H:i:s")."'
					where id=".$_GET["id"]);
					
					$q=mysql_query("SELECT * from CAV_pac where id=".$_GET["id"]);
	while ($str=mysql_fetch_array($q,MYSQL_ASSOC)){if($str["id"]!=""){$tt0=$str["time"];$ta0=$str["time_way"];$id_doc0=$str["id_doc"];$dt0=$str["date_p"];}}
	echo "SELECT * from CAV_pac where id_doc=".$id_doc0." and date_p='".$dt0."' and time_after is null order by time";
	$q=mysql_query("SELECT * from CAV_pac where id_doc=".$id_doc0." and date_p='".$dt0."' and time_after is null order by time");

unset($qq);				
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}
$findfirst=0;
foreach ($qq as $r)
	if (($r["id"]!="")&&($findfirst!=0))		
		{$ttr=explode(":",$r["time"]);
		 $ttr0=explode(":",$tt0);
				 if(!isset($ttr[2]))$ttr[2]=0;
				 $ttstr=explode(":",$ta0);
				 if(!isset($ttstr[2]))$ttstr[2]=0;
				 $ttt=$ttstr[0]*60*60+$ttstr[1]*60+$ttstr[2]+($ttr[0]*60*60+$ttr[1]*60+$ttr[2]-$ttr0[0]*60*60-$ttr0[1]*60-$ttr0[2]);
				
				echo "update CAV_pac 
				set time_way='".floor($ttt/3600).":".floor(($ttt-(floor($ttt/3600)*60*60))/60).":".($ttt % 60)."'
				where id=".$r["id"]."";
				 
				 $q=mysql_query("update CAV_pac 
                   set time_way='".floor($ttt/3600).":".floor(($ttt-(floor($ttt/3600)*60*60))/60).":".($ttt % 60)."'
					where id=".$r["id"]."");
			}
			else $findfirst=1;
		
}


if((isset($_GET["btn_doc"]))&&($_GET["btn_doc"]=="Подтвердить"))
	{
	$q=mysql_query("SELECT * from CAV_pac where id_doc=".$_GET["id_doc"]." and date_p='".date("Y-m-d")."' and time_after is null order by time");

unset($qq);				
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}
foreach ($qq as $r)
	if ($r["id"]!="")	
		{
				 $ttstr=explode(":",$r["time_way"]);
				 if(!isset($ttstr[2]))$ttstr[2]=0;
				 $ttt=$ttstr[0]*60*60+$ttstr[1]*60+$ttstr[2]+$_GET["break_time"]*60;

				echo "update CAV_pac 
				set time_way='".floor($ttt/3600).":".floor(($ttt-(floor($ttt/3600)*60*60))/60).":".($ttt % 60)."'
				where id=".$r["id"]."";
				 
				 $q=mysql_query("update CAV_pac 
                   set time_way='".floor($ttt/3600).":".floor(($ttt-(floor($ttt/3600)*60*60))/60).":".($ttt % 60)."'
					where id=".$r["id"]."");
		}	
	}
	

$q=mysql_query("SELECT CAV_pac.* ,
				CAV_individ.fam,CAV_individ.name
				from CAV_pac 
				LEFT JOIN CAV_individ ON CAV_individ.id=CAV_pac.id_ind_pac
				where id_doc=".$_GET["id_doc"]."
				and date_p='".$_GET["c_Y"]."-".$_GET["c_m"]."-".$_GET["c_d"]."'  order by time");
unset($qq);				
while ($qq[]=mysql_fetch_array($q,MYSQL_ASSOC)){}

foreach ($qq as $r)
{
	if ($r["id_ind_pac"]!="")
		{
		echo "<tr>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\"><h3>".$r["fam"]." ".$r["name"]."</h3></td>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\"><h3>".$r["time_way"]."</h3>
		 ";
		if($r["time_after"]=="")
				echo "<form action=\"tabledoc.php\" method=get>
						<input name=btn_beg type=submit value=\"Начало приёма\">
						<input name=id style=\"display:none;\" value=".$r["id"]." >
						<input name=id_doc style=\"display:none;\" value=".$r["id_doc"]." >
						<input name=c_Y style=\"display:none;\" value=".$_GET["c_Y"]." >
						<input name=c_m style=\"display:none;\" value=".$_GET["c_m"]." >
						<input name=c_d style=\"display:none;\" value=".$_GET["c_d"]." >
						</form>";
		echo "</td>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\">";
		if($r["time_after"]=="")
				echo "<form action=\"tabledoc.php\" method=get>
						<input name=btn_end type=submit value=\"Приём окончен\">
						<input name=id style=\"display:none;\" value=".$r["id"]." >
						<input name=id_doc style=\"display:none;\" value=".$r["id_doc"]." >
						<input name=c_Y style=\"display:none;\" value=".$_GET["c_Y"]." >
						<input name=c_m style=\"display:none;\" value=".$_GET["c_m"]." >
						<input name=c_d style=\"display:none;\" value=".$_GET["c_d"]." >
						</form>";
				else echo $r["time_after"];
		echo "</td>
		<td align=center style=\"width:200;height:40;border-style:solid;border-width:1;background-color: #f5e8d0;\"><h3>".$r["time_arrived"]."</h3></td>
	  </tr>";
		}

}
echo	"<form action=\"tabledoc.php\" method=get>
	   <p style=\"position:absolute;right: 200;\">Я ушёл на<input id=break_time name=break_time>минут.</p>
	   <input id=id_doc style=\"display:none;\" name=id_doc value=".$_GET["id_doc"].">
	   <p style=\"position:absolute;top: 25; right: 100;\"><input id=btn_doc name=btn_doc type=submit value=Подтвердить></p>
	  </form>";

?>

</table>
