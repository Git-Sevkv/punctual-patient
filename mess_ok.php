﻿﻿﻿﻿﻿﻿﻿﻿﻿<meta http-equiv="Content-Type" content="text/css; charset=utf-8">

<?php
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
if(!isset($_GET["id_doc"])||!isset($_GET["s_d"])||!isset($_GET["id_s"]))die("Нет данных!");



if(!is_dir("m".$_GET["id_doc"]))mkdir("m".$_GET["id_doc"]);

if(file_exists("m".$_GET["id_doc"]."/mess1.php"))include("m".$_GET["id_doc"]."/mess1.php");
$_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["from"]=$_SESSION["id"];
if(isset($_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"])&&($_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"]==1))
	$_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"]=0;
	else $_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"]=1;
$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');

//Машинное обучение и прогнозирование
$tt_per=10;//Время для первичного осмотра
$q=mysql_query("select * from CAV_pac where CAV_pac.id_doc=".$_GET["id_doc"]." and CAV_pac.id_ind_pac=".$_SESSION["id"]." and vipisan=0");
unset($qqp);
while ($qqp[]=mysql_fetch_array($q,MYSQL_ASSOC)){}
foreach($qqp as $rp)
	if($rp["id"]!="")
		{$tt_per=0;}
	
$q=mysql_query("select * from CAV_pac where CAV_pac.id_doc=".$_GET["id_doc"]."");
unset($qqp);
while ($qqp[]=mysql_fetch_array($q,MYSQL_ASSOC)){}



foreach($qqp as $rp)
	if($rp["id"]!="")
		{
		 $q=mysql_query("select CAV_xar.*,CAV_par.factor from CAV_xar 
							left join CAV_par on CAV_par.id=CAV_xar.id_par
							where CAV_xar.id_ind=".$rp["id_ind_pac"]." and CAV_xar.id_parent is NULL");
		 unset($qqx);
		 while ($qqx[]=mysql_fetch_array($q,MYSQL_ASSOC)){}
		foreach($qqx as $rx)
			if($rx["time_after"]!="")
				{$w[$rx["id_par"]]=$rx["factor"];
				 $ttt=explode(":",$rp["time_after"]);
				 $tts=explode(":",$rp["time_way_fact"]);
				 if(isset($nu[$rx["id_par"]]))
					{$nu[$rx["id_par"]]["time"]+=$ttt[0]*60+$ttt[1]-($tts[0]*60+$tts[1]);$nu[$rx["id_par"]]["n"]++;}
					else {$nu[$rx["id_par"]]["time"]=$ttt[0]*60+$ttt[1]-($tts[0]*60+$tts[1]);$nu[$rx["id_par"]]["n"]=1;}
				}

		}
$t_rasch=$tt_per;	$t_rasch_0=0;	
if(isset($_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]+1]))
	{
	$tts=explode(":",$_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["body"]);
	$ttt=explode(":",$_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]+1]["body"]);		
	$t_rasch_0=$ttt[0]*60+$ttt[1]-($tts[0]*60+$tts[1]);
	$t_rasch=$ttt[0]*60+$ttt[1]-($tts[0]*60+$tts[1]);
	}
$s_ch=0;$s_zn=0;
foreach($nu as $k_nu => $p_nu)
	{
	 $s_ch+=$w[$k_nu]*$nu[$k_nu]["time"]/$nu[$k_nu]["n"];
	 $s_zn+=$w[$k_nu];
	}

if($s_zn!=0)
	$t_rasch=$s_ch/$s_zn+$tt_per;	

///Пересчет времени

foreach($_SESSION["mess"][$_GET["s_d"]] as $k_peresch =>  $t_peresch)
	if($k_peresch>$_GET["id_s"])
		{
		 $ttn=explode(":",$_SESSION["mess"][$_GET["s_d"]][$k_peresch]["body"]);
		 $tttn=$ttn[0]*60+$ttn[1]+$t_rasch-$t_rasch_0;
		 
		if($_SESSION["mess"][$_GET["s_d"]][$k_peresch]["from"]=="")
			$_SESSION["mess"][$_GET["s_d"]][$k_peresch]["body"]=floor($tttn / 60).":".($tttn % 60);
		}
////////////////////	
	
$str="<?php ";
foreach($_SESSION["mess"] as $k_ms => $ms)
	foreach($ms as $kk_ms => $mms)
		foreach($mms as $kkk_ms => $mmms)
			$str.="$"."_SESSION[\"mess\"][\"".$k_ms."\"][\"".$kk_ms."\"][\"".$kkk_ms."\"]=\"".$mmms."\";";
$str.=" ?>";
echo $str;
file_put_contents("m".$_GET["id_doc"]."/mess1.php", $str);



if(isset($_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"])&&($_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"]==1))
{
$_GET["id"]=1;
	$q=mysql_query("select max(id)+1 as mxid from CAV_pac");
while ($str=mysql_fetch_array($q,MYSQL_ASSOC)){if($str["mxid"]!="")$_GET["id"]=$str["mxid"];}
 
//echo "insert into CAV_pac (id,id_ind_pac,id_doc,time)
		   //values(".$_GET["id"].",".$_GET["id_ind_pac"].",
			  //'".$_GET["id_doc"]."','".$_GET["tm"]."')";
//file_put_contents("test.php","insert into CAV_pac (id,id_ind_pac,id_doc,date_p,time,time_way)
		   //values(".$_GET["id"].",".$_SESSION["id"].",
			 // '".$_GET["id_doc"]."','".$_GET["s_d"]."','".$_GET["tm"]."','".$_GET["tm"]."')");
			 
$s_d=explode("_",$_GET["s_d"]);
$q=mysql_query("insert into CAV_pac (id,id_ind_pac,id_doc,date_p,time,time_way)
		   values(".$_GET["id"].",".$_SESSION["id"].",
			  '".$_GET["id_doc"]."','".$s_d[2]."-".$s_d[1]."-".$s_d[0]."','".$_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["body"]."','".$_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["body"]."')");
} else $q=mysql_query("delete from CAV_pac
		   where id_ind_pac=".$_SESSION["id"]." and id_doc='".$_GET["id_doc"]."' and time='".$_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["body"]."'");
?>