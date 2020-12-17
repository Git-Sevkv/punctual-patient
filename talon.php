﻿﻿﻿﻿﻿﻿﻿﻿﻿<meta http-equiv="Content-Type" content="text/css; charset=utf-8">
<h1>Планирование приема</h1>
﻿
<?php
session_start();
//print_r($_GET);
foreach($_SESSION["mess"] as $k_ms => $ms)
	{foreach($ms as $kk_ms => $mms)
		{foreach($mms as $kkk_ms => $mmms)
			unset($_SESSION["mess"][$k_ms][$kk_ms][$kkk_ms]);
		unset($_SESSION["mess"][$k_ms][$kk_ms]);
		}
	unset($_SESSION["mess"][$k_ms]);
	}
unset($_SESSION["mess"]);
if(!isset($_GET["id_doc"])||!isset($_GET["s_d"])||!isset($_GET["t_s"])||!isset($_GET["n_t"])||!isset($_GET["dt"]))die("Нет данных!");


if(!is_dir("m".$_GET["id_doc"]))mkdir("m".$_GET["id_doc"]);

if(file_exists("m".$_GET["id_doc"]."/mess1.php"))include("m".$_GET["id_doc"]."/mess1.php");
$ddd=explode("-",$_GET["s_d"]);
for($i=0;$i<$_GET["n_t"];$i++)
	{
	$ttt=explode(":",$_GET["t_s"]);
	echo $ttt[0]."*60+".$ttt[1]."+".$i."*".$_GET["dt"]."=".($ttt[0]*60+$ttt[1]+$i*$_GET["dt"])."<br>";
	$ttt_new=$ttt[0]*60+$ttt[1]+$i*$_GET["dt"];
	$_SESSION["mess"][$_GET["s_d"]][$i]["from"]="";
	$_SESSION["mess"][$_GET["s_d"]][$i]["w_ok"]="0";
	if(($ttt_new % 60-0)<10-0)
		$_SESSION["mess"][$ddd[2]."_".$ddd[1]."_".$ddd[0]][$i]["body"]=floor($ttt_new / 60).":0".($ttt_new % 60);
	else $_SESSION["mess"][$ddd[2]."_".$ddd[1]."_".$ddd[0]][$i]["body"]=floor($ttt_new / 60).":".($ttt_new % 60);
	}

$str="<?php ";
foreach($_SESSION["mess"] as $k_ms => $ms)
	foreach($ms as $kk_ms => $mms)
		foreach($mms as $kkk_ms => $mmms)
			$str.="$"."_SESSION[\"mess\"][\"".$k_ms."\"][\"".$kk_ms."\"][\"".$kkk_ms."\"]=\"".$mmms."\";";
$str.=" ?>";
echo $str;
file_put_contents("m".$_GET["id_doc"]."/mess1.php", $str);


?>