﻿

<?php

//print_r($_GET);

$Link=mysql_connect('u464554.mysql.masterhost.ru','u464554','c_m4sSIOTi');

if(!$Link)die('Нет подключения к БД!');

@mysql_query('SET NAMES utf8');

mysql_select_db('u464554');

if($_GET["btn_e"]=="Зарегистрироваться")
   {$_GET["id"]=1;
	$q=mysql_query("select max(id)+1 as mxid from CAV_individ");
	while ($str=mysql_fetch_array($q,MYSQL_ASSOC)){if($str["mxid"]!="")$_GET["id"]=$str["mxid"];}
	$_GET["password"] = hash("sha512", $_GET["password"]);
echo "insert into CAV_individ (id,fam,name,s_name,date_of_brth,login,password) 
		   values(".$_GET["id"].",
		   ".$_GET["fam"].",
		   ".$_GET["name"].",
		   ".$_GET["s_name"].",
		   ".$_GET["date_of_brth"].",
		   ".$_GET["login"].",
		          '".$_GET["password"]."')";
    $q=mysql_query("insert into CAV_individ (id,fam,name,s_name,date_of_brth,login,password) 
		   values(".$_GET["id"].",
		   '".$_GET["fam"]."',
		   '".$_GET["name"]."',
		   '".$_GET["s_name"]."',
		   '".$_GET["date_of_brth"]."',
		   '".$_GET["login"]."',
		          '".$_GET["password"]."')");


     echo "<h3>Добавлен: ".$_GET["fam"]."</h3>";
    }
	
	
	

?>

 <p><a href="registration.php">Вернуться назад</a></p> 