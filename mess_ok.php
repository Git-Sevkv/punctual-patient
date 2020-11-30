﻿﻿﻿﻿﻿﻿﻿<meta http-equiv="Content-Type" content="text/css; charset=utf-8">

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
if(isset($_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"])&&($_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"]==1))$_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"]=0;else $_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"]=1;
$str="<?php ";
foreach($_SESSION["mess"] as $k_ms => $ms)
	foreach($ms as $kk_ms => $mms)
		foreach($mms as $kkk_ms => $mmms)
			$str.="$"."_SESSION[\"mess\"][\"".$k_ms."\"][\"".$kk_ms."\"][\"".$kkk_ms."\"]=\"".$mmms."\";";
$str.=" ?>";
echo $str;
file_put_contents("m".$_GET["id_doc"]."/mess1.php", $str);


print_r($_GET);

$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');

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
			  '".$_GET["id_doc"]."','".$s_d[2]."-".$s_d[1]."-".$s_d[0]."','".$_GET["tm"]."','".$_GET["tm"]."')");
} else $q=mysql_query("delete from CAV_pac
		   where id_ind_pac=".$_SESSION["id"]." and id_doc='".$_GET["id_doc"]."' and time='".$_GET["tm"]."'");
?>