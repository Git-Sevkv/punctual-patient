<meta http-equiv="Content-Type" content="text/css; charset=utf-8">

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
if(!isset($_GET["id_ind"])||!isset($_GET["c_Y"])||!isset($_GET["c_m"])||!isset($_GET["c_d"])||!isset($_GET["body"])||!isset($_GET["from"]))die("Нет данных!");
if(!is_dir("m".$_GET["id_ind"]))mkdir("m".$_GET["id_ind"]);

if(file_exists("m".$_GET["id_ind"]."/mess1.php"))include("m".$_GET["id_ind"]."/mess1.php");
if($_GET["c_d"]-0>9-0)$str_d=$_GET["c_d"];else $str_d="0".$_GET["c_d"];
if($_GET["c_m"]-0>9-0)$str_m=$_GET["c_m"];else $str_m="0".$_GET["c_m"];
$str_Y=$_GET["c_Y"];
$_SESSION["mess"][$str_d."_".$str_m."_".$_GET["c_Y"]][]["body"]=$_GET["body"];
$_SESSION["mess"][$str_d."_".$str_m."_".$_GET["c_Y"]][max(array_keys($_SESSION["mess"][$str_d."_".$str_m."_".$_GET["c_Y"]]))]["from"]=$_GET["from"];
$str="<?php ";
foreach($_SESSION["mess"] as $k_ms => $ms)
	foreach($ms as $kk_ms => $mms)
		foreach($mms as $kkk_ms => $mmms)
			$str.="$"."_SESSION[\"mess\"][\"".$k_ms."\"][\"".$kk_ms."\"][\"".$kkk_ms."\"]=\"".$mmms."\";";
$str.=" ?>";
echo $str;
file_put_contents("m".$_GET["id_ind"]."/mess1.php", $str);
?>