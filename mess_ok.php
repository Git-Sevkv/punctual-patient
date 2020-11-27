﻿﻿<meta http-equiv="Content-Type" content="text/css; charset=utf-8">

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
if(!isset($_GET["id_ind"])||!isset($_GET["s_d"])||!isset($_GET["id_s"]))die("Нет данных!");


if(!is_dir("m".$_GET["id_ind"]))mkdir("m".$_GET["id_ind"]);

if(file_exists("m".$_GET["id_ind"]."/mess1.php"))include("m".$_GET["id_ind"]."/mess1.php");
$_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["from"]=$_SESSION["id"];
if(isset($_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"])&&($_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"]==1))$_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"]=0;else $_SESSION["mess"][$_GET["s_d"]][$_GET["id_s"]]["w_ok"]=1;
$str="<?php ";
foreach($_SESSION["mess"] as $k_ms => $ms)
	foreach($ms as $kk_ms => $mms)
		foreach($mms as $kkk_ms => $mmms)
			$str.="$"."_SESSION[\"mess\"][\"".$k_ms."\"][\"".$kk_ms."\"][\"".$kkk_ms."\"]=\"".$mmms."\";";
$str.=" ?>";
echo $str;
file_put_contents("m".$_GET["id_ind"]."/mess1.php", $str);

?>